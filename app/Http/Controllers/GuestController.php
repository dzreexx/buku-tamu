<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest', [
            'title' => 'Selamat Datang'
        ]);
    }

    public function ticket($id)
    {
        $guest = Guest::findOrFail($id);
        return view('postreq', [
            'title' => 'Ticket Tamu',
            'guest' => $guest
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
        'telp.digits_between' => 'Nomor telepon maksimal 13 digit.',
        'nik.required' => 'NIK harus diisi.',
        'nik.numeric' => 'NIK harus berupa angka.',
        'nik.digits' => 'NIK salah NIK harus 16 digit.',
        'password.required' => 'Password harus diisi.',
        'selfie.required' => 'Anda Harus Mengambil Foto Selfie.',
        'selfie.max' => 'Maksimal Ukuran Foto 2MB.',
        'ket.required' => 'Keterangan Harus Di isi.',
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
    } else {

        $validatedData = $request->validate([
            'nama' => 'required',
            'telp' => ['required', 'numeric', 'digits_between:1,13'],
            'nik' => ['required', 'numeric', 'digits:16'],
            'ket' => 'required',
            'selfie' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        if ($request->hasFile('selfie')) {
            $image = $request->file('selfie');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('selfies', $imageName, 'public');
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
            'check_in_at' => Carbon::now(),
            'selfie_path' => $imagePath,
            'user_id' => $userId,
        ]);
    }

    return redirect()->route('guest.ticket', ['id' => $guest->id]);
}

    public function checkOut($id)
    {
        $user = Auth::user();

        $guest = Guest::findOrFail($id);
        $ticket = $guest->ticket;

        if (!$user) {
            // Hapus file selfie jika ada
            if ($guest->selfie_path && Storage::disk('public')->exists($guest->selfie_path)) {
                Storage::disk('public')->delete($guest->selfie_path);
            }
        }

        if ($ticket) {
            $ticket->is_used = false;
            $ticket->save();
        }

        $guest->update(['check_out_at' => Carbon::now()]);

        return redirect()->route('guest.index')->with('status', 'Tamu telah keluar dan tiket tersedia kembali.');
    }
}
