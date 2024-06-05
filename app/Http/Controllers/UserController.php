<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Guest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sign-up',[
            'title' => 'Selamat Datang'
        ]);
    }

    public function ticket($id)
    {
        $user = User::findOrFail($id);
        return view('postreq', [
            'title' => 'Ticket Tamu',
            'user' => $user
        ]);
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        'nik.digits' => 'NIK harus tepat 16 digit.',
        'img_profile.required' => 'Anda Harus Mengambil Foto Selfie.',
        'img_profile.max' => 'Maksimal Ukuran Foto 2MB.',
        'password.required' => 'Password harus diisi.',
    ];

    $validatedData = $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:users,email',
        'telp' => ['required','unique:users,telp', 'numeric', 'digits_between:10,13'],
        'nik' => ['required','unique:users,nik', 'numeric', 'digits:16'],
        'password' => 'required',
        'img_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ],$messages);

    if ($request->hasFile('img_profile')) {
        $image = $request->file('img_profile');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('img_profiles', $imageName, 'public'); // Menyimpan gambar ke dalam folder 'selfies' di dalam direktori 'storage/app/public'
    }
    // // Proses upload selfie
    // if ($request->hasFile('selfie')) {
    //     $image = $request->file('selfie');
    //     $imageName = time() . '_' . $image->getClientOriginalName();
    //     $imagePath = $image->storeAs('selfies', $imageName, 'public'); // Menyimpan gambar ke dalam folder 'selfies' di dalam direktori 'storage/app/public'
    // }

    // // Dapatkan tiket yang tersedia atau buat yang baru jika tidak ada
    // $ticket = Ticket::where('is_used', false)->first();

    // if (!$ticket) {
    //     $lastTicket = Ticket::latest()->first();
    //     $ticketNumber = $lastTicket ? intval($lastTicket->number) + 1 : 1;
    //     $ticketNumber = str_pad($ticketNumber, 4, '0', STR_PAD_LEFT);

    //     $ticket = Ticket::create([
    //         'number' => $ticketNumber,
    //     ]);
    // }

    // $ticket->is_used = true;
    // $ticket->save();

    $user = User::create([
        'nama' => $validatedData['nama'],
        'email' => $validatedData['email'],
        'telp' => $validatedData['telp'],
        'nik' => $validatedData['nik'],
        'password' => $validatedData['password'],
        'img_path' => $imagePath ?? null,
        // 'ket' => $validatedData['ket'],
        // 'ticket_id' => $ticket->id,
        // 'check_in_at' => Carbon::now(),
        // 'selfie_path' => $imagePath ?? null, // Simpan path gambar selfie
    ]);

    return redirect()->route('user.login');
}


public function login()
{
    return view('login',[
        'title' => 'Halaman Login'
    ]);
}

public function authentication(Request $request)
{
    $credentials = $request->validate([
        'telp' => 'required|integer',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials))
    {
        // Regenerasi sesi untuk keamanan
        $request->session()->regenerate();

        // Periksa apakah pengguna adalah admin
        if (Auth::user()->is_admin) {
            // Jika admin, arahkan ke /main
            return redirect()->intended('/admin');
        } else {
            return redirect()->intended('/main');
            // Jika bukan admin, arahkan ke rute lain
        }
    }
    return back()->with('loginError', 'Login Gagal!');
}

public function main()
{
    $news = News::latest()->paginate(10);

    return view('main-user',[
        'title' => 'Halaman Utama',
        'page' => 'Beranda',
        'user' => Auth::user(),
        'news' => $news,
    ]);
}

public function kunjungan()
{
    $user = Auth::user();
    $guests = Guest::where('user_id',$user->id)->get();
    return view('kunjungan',[
        'title' => 'Kunjungan',
        'page' => 'Kunjungan',
    ],compact('guests'));
}

public function userGuest()
{
    return view('user-guest',[
        'title' => 'Pendaftaran Kunjungan',
        'user' => Auth::user(),
    ]);

}

public function userProfile()
{
    return view('profile',[
        'title' => 'User Profil',
        'page' => 'Profil',
        // 'user' => Auth::user(),
    ]);
}

public function editProfile()
{
    return view('edit-profile',[
        'title' => 'Ubah Profil',
        'page' => 'Ubah Profil'
    ]);
}

public function updateProfile(Request $request)
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
        'nik.digits' => 'NIK harus tepat 16 digit.',
        'img_profile.required' => 'Anda Harus Mengambil Foto Selfie.',
        'img_profile.max' => 'Maksimal Ukuran Foto 2MB.',
        'password.required' => 'Password harus diisi.',
    ];

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'telp' => 'required|string|max:255',
        'nik' => 'required|string|max:255',
        'password' => 'nullable|string', // Jika password tidak diisi, maka tidak validasi
        'img_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
    ],$messages);

    // Ambil data user yang sedang login
    $user = Auth::user();

    // Perbarui informasi profil
    $user->nama = $request->nama;
    $user->email = $request->email;
    $user->telp = $request->telp;
    $user->nik = $request->nik;

    // Perbarui password jika diisi
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    // Perbarui foto profil jika diunggah
    if ($request->hasFile('img_profile')) {
        // Hapus foto lama jika ada
        if ($user->img_path) {
            Storage::disk('public')->delete($user->img_path);
        }
        // Simpan foto baru
        $imgPath = $request->file('img_profile')->store('img_profiles', 'public');
        $user->img_path = $imgPath;
    }

    // Simpan perubahan
    $user->save();

    // Redirect ke halaman profil dengan pesan sukses
    return redirect()->route('user-profile')->with('success', 'Profil berhasil diperbarui.');
}

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $ValidatedDoc = $request->validate([
    //         'nama' => 'required',
    //         'telp' => 'required',
    //         'nik' => ['required', 'numeric', ],
    //         'ket' => 'required',
    //     ]);

    //     // Dapatkan tiket yang tersedia atau buat yang baru jika tidak ada
    //     $ticket = Ticket::where('is_used', false)->first();

    //     if (!$ticket) {
    //         $lastTicket = Ticket::latest()->first();
    //         $ticketNumber = $lastTicket ? intval($lastTicket->number) + 1 : 1;
    //         $ticketNumber = str_pad($ticketNumber, 4, '0', STR_PAD_LEFT);

    //         $ticket = Ticket::create([
    //             'number' => $ticketNumber,
    //         ]);
    //     }

    //     $ticket->is_used = true;
    //     $ticket->save();

    //     $user = User::create([
    //         'nama' => $request->nama,
    //         'telp' => $request->telp,
    //         'nik' => $request->nik,
    //         'ket' => $request->ket,
    //         'ticket_id' => $ticket->id,
    //         'check_in_at' => Carbon::now(),
    //     ]);

    //     // User::create($ValidatedDoc);
    //     // return redirect('req/{id}');
    //     // return redirect()->route('req/{id}', $ValidatedDoc);
    //     // $user = User::create($request->all());
    //     return redirect()->route('user.ticket', ['id' => $user->id]);
    // }

    // public function checkOut($id)
    // {
    //     $user = User::findOrFail($id);
    //     $ticket = $user->ticket;

    //     if ($ticket) {
    //         $ticket->is_used = false;
    //         $ticket->save();
    //     }

    //     $user->update(['check_out_at' => Carbon::now()]);

    //     return redirect()->route('user.index')->with('status', 'Tamu telah keluar dan tiket tersedia kembali.');
    // }
    
    public function checkOut($id)
    {
        $user = User::findOrFail($id);
        $ticket = $user->ticket;

        // Hapus file selfie jika ada
        if ($user->selfie_path && Storage::disk('public')->exists($user->selfie_path)) {
            Storage::disk('public')->delete($user->selfie_path);
        }

        if ($ticket) {
            $ticket->is_used = false;
            $ticket->save();
        }

        $user->update(['check_out_at' => Carbon::now()]);

        return redirect()->route('user.index')->with('status', 'Tamu telah keluar dan tiket tersedia kembali.');
    }

    public function about()
    {
        return view('about', [
            'title' => 'Halaman Tentang',
            'page' => 'Tentang',
        ]);
    }
    
    public function info()
    {
        return view('info', [
            'title' => 'Halaman Informasi',
            'page' => 'Informasi',
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Hapus gambar profil dari storage jika ada
        if ($user->img_path) {
            Storage::delete($user->img_path);
        }

        // Hapus user dari database
        $user->delete();

        // Redirect atau memberikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->route('admin-user')->with('success', 'Pengguna Berhasil di Hapus.');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
