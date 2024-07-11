<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Guest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest', [
            'title' => 'Selamat Datang',
            'page' => 'Kunjungan',
        ]);
    }

    public function ticket($id)
    {
        $guestId = Crypt::decrypt($id);
        $guest = Guest::findOrFail($guestId);
        $sessionIni = Session::get('guest_id');
        return view('postreq', [
            'title' => 'Ticket Tamu',
            'guest' => $guest,
            'id' => $id,
        ]);
    }

    public function store(Request $request)
{
    $messages = [
        'nama.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'telp.required' => 'Nomor telepon harus diisi.',
        'telp.numeric' => 'Nomor telepon harus berupa angka.',
        'telp.digits_between' => 'Nomor telepon harus diantara 10-13 digits',
        'nik.required' => 'NIK harus diisi.',
        'nik.numeric' => 'NIK harus berupa angka.',
        'nik.digits' => 'NIK salah NIK harus 16 digit.',
        'password.required' => 'Password harus diisi.',
        'selfie.required' => 'Anda Harus Mengambil Foto Selfie.',
        // 'selfie.max' => 'Maksimal Ukuran Foto 2MB.',
        'ket.required' => 'Keterangan Harus Di isi.',
        'required' => 'Tolong isi saya bukan Robot.',
        'captcha' => 'Captcha error! coba lagi nanti, atau tanyakan pada petugas.',
    ];

    

    $ticket = Ticket::where('is_used', false)->first();
    if (!$ticket) {
        $lastTicket = Ticket::latest()->first();
        $ticketNumber = $lastTicket ? intval($lastTicket->number) + 1 : 1;
        $ticketNumber = str_pad($ticketNumber, 4, '0', STR_PAD_LEFT);

        $ticket = Ticket::create(['number' => $ticketNumber]);
    }

    $ticket->is_used = true;
    $ticket->save();

    $user = Auth::user();
    $imagePath = null;

    if ($user) {
        // dd($request);
        $guest = Guest::create([
            'nama' => $user->nama,
            'telp' => $user->telp,
            'nik' => $user->nik,
            'ket' => $request->input('ket'),
            'ticket_id' => $ticket->id,
            'check_in_at' => Carbon::now(),
            'selfie_path' => $user->img_path,
            'user_id' => $user->id,
        ]);
        $encryptedId = Crypt::encrypt($guest->id);
        $request->session()->regenerate();
        $request->session()->put('guest_id', $encryptedId);
        $user->guest_id = $guest->id;
        $user->save();
    } else {

        $validatedData = $request->validate([
            'nama' => 'required',
            'telp' => ['required', 'numeric', 'digits_between:10,13'],
            'nik' => ['required', 'numeric', 'digits:16'],
            'ket' => 'required',
            // 'selfie' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'selfie' => 'required|image|mimes:jpeg,png,jpg,gif',
            'g-recaptcha-response' => 'required|captcha',
        ], $messages);

        if ($request->hasFile('selfie')) {
            $image = $request->file('selfie');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $img = $image->storeAs('selfies', $imageName, 'public');
            $imagePath = explode('/', $img);
        }

        $user = Auth::user();
        $userId = null;

        if ($user) {
            $userId = $user->id;
        } else {
            // Cari user berdasarkan nik
            $userFromNik = User::where('nik', $validatedData['nik'])->first();
            if ($userFromNik) {
                $userId = $userFromNik->id;
            }
        }

        $guest = Guest::create([
            'nama' => $validatedData['nama'],
            'telp' => $validatedData['telp'],
            'nik' => $validatedData['nik'],
            'ket' => $validatedData['ket'],
            'ticket_id' => $ticket->id,
            'check_in_at' => Carbon::now('Asia/Jakarta'),
            'selfie_path' => $imagePath[1],
            'user_id' => $userId,
        ]);

        $encryptedId = Crypt::encrypt($guest->id);
        $request->session()->regenerate();
        $request->session()->put('guest_id', $encryptedId);
    }
    
    $encryptedId = Crypt::encrypt($guest->id);
    return redirect()->route('guest.ticket', ['id' => $encryptedId]);
}

    public function checkOut(Request $request, $id)
    {
        $user = Auth::user();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $guest = Guest::findOrFail($id);
        $ticket = $guest->ticket;

        //fungsi untuk menghapus file gambar di storage
        // if (!$user) {
        //     // Hapus file selfie jika ada
        //     if ($guest->selfie_path && Storage::disk('public')->exists($guest->selfie_path)) {
        //         Storage::disk('public')->delete($guest->selfie_path);
        //     }
        // }

        if ($ticket) {
            $ticket->is_used = false;
            $ticket->save();
        }

        if ($user) {
            $user->guest_id = null;
            $user->save();
        }
        $guest->update(['check_out_at' => Carbon::now('Asia/Jakarta')]);

        return redirect()->route('beranda')->with('status', 'Tamu telah keluar dan tiket tersedia kembali.');
    }
}
