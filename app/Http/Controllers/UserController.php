<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Guest;
use App\Models\News;
use App\Models\Info;
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
        'email.unique' => 'Email sudah digunakan.',
        'email.email' => 'Format email tidak valid.',
        'telp.required' => 'Nomor telepon harus diisi.',
        'telp.unique' => 'Nomor Telepon sudah digunakan.',
        'telp.numeric' => 'Nomor telepon harus berupa angka.',
        'telp.digits_between' => 'Nomor telepon maksimal 13 digit.',
        'nik.required' => 'NIK harus diisi.',
        'nik.unique' => 'NIK sudah digunakan.',
        'nik.numeric' => 'NIK harus berupa angka.',
        'nik.digits' => 'NIK harus tepat 16 digit.',
        'img_profile.required' => 'Anda Harus Mengambil Foto Selfie.',
        // 'img_profile.max' => 'Maksimal Ukuran Foto 2MB.',
        'password.required' => 'Password harus diisi.',
        'g-recaptcha-response.required' => 'Tolong isi saya bukan Robot.',
        'captcha' => 'Captcha error! coba lagi nanti, atau tanyakan pada petugas.',
    ];

    $validatedData = $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:users,email',
        'telp' => ['required','unique:users,telp', 'numeric', 'digits_between:10,13'],
        'nik' => ['required','unique:users,nik', 'numeric', 'digits:16'],
        'password' => 'required',
        // 'img_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'img_profile' => 'required|image|mimes:jpeg,png,jpg,gif',
        'g-recaptcha-response' => 'required|captcha',
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

    return redirect()->route('login');
}


public function login()
{
    return view('login',[
        'title' => 'Halaman Login'
    ]);
}

public function authentication(Request $request)
{
    $messages = [
        'telp.required' => 'telepon harus diisi',
        'telp.integer' => 'telepon harus berupa nomor',
        'password.required' => 'password harus diisi',
    ];
    $credentials = $request->validate([
        'telp' => 'required|integer',
        'password' => 'required',
    ], $messages);

    if (Auth::attempt($credentials))
    {
        // Regenerasi sesi untuk keamanan
        $request->session()->regenerate();

        // Periksa apakah pengguna adalah admin
        if (Auth::user()->is_admin) {
            // Jika admin, arahkan ke /main
            return redirect()->intended('/admin');
        } else {
            return redirect()->intended('/');
            // Jika bukan admin, arahkan ke rute lain
        }
    }
    return back()->with('loginError', 'Telepon atau password salah');
}

public function main()
{
    $news = News::latest()->paginate(10);

    return view('main-user',[
        'title' => 'Halaman Utama',
        'page' => 'Beranda',
        'judul' => 'Selamat Datang',
        'desc' => '',
        'thumbnail' => 'images/disinfolahtal.png',
        'user' => Auth::user(),
        'news' => $news,
    ]);
}

public function berita($id)
{
    $berita = News::with('user')->findOrFail($id);
    $berita->formatted_date = Carbon::parse($berita->created_at)->translatedFormat('l, d F Y');

    return view('user-news',[
        'title' => 'Baca Berita',
        'page' => 'Berita',
        'judul' => 'Berita',
        'berita' => $berita,
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
    $user = Auth::user();
    return view('edit-profile',[
        'title' => 'Ubah Profil',
        'page' => 'Ubah Profil',
        'user' => $user,
    ]);
}

public function updateProfile(Request $request)
{
    $user = Auth::user();
    $messages = [
        'nama.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email telah digunakan.',
        'telp.required' => 'Nomor telepon harus diisi.',
        'telp.numeric' => 'Nomor telepon harus berupa angka.',
        'telp.digits_between' => 'Nomor telepon tidak valid.',
        'nik.required' => 'NIK harus diisi.',
        'nik.numeric' => 'NIK harus berupa angka.',
        'nik.digits' => 'NIK harus tepat 16 digit.',
        'img_path.required' => 'Anda Harus Mengambil Foto Selfie.',
        'img_path.mimes' => 'File harus berformat jpeg, jpg, png, gif.',
        'img_path.image' => 'File harus berformat gambar.',
        // 'img_profile.max' => 'Maksimal Ukuran Foto 2MB.',
        'password.required' => 'Password harus diisi.',
    ];

    // Validasi input
    $rules = [
        'nama' => 'required',
         // Jika password tidak diisi, maka tidak validasi
        // 'img_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        
    ];

    if ($request->telp != $user->telp) {
        $rules['telp'] = ['required','unique:users,telp', 'numeric', 'digits_between:10,13'];
    }

    if ($request->nik != $user->nik) {
        $rules['nik'] = ['required','unique:users,nik', 'numeric', 'digits:16'];
    }

    if ($request->email != $user->email) {
        $rules['email'] = 'required|email|unique:users';
    }

    if ($request->filled('password')) {
        $rules['password'] = 'required';
    }


    if ($request->hasFile('img_path')) {
        $rules['img_path'] = 'required|image|mimes:jpeg,png,jpg,gif';
        $imgPath = $request->file('img_path')->store('img_profiles', 'public');
        
    }

    $validatedData = $request->validate($rules, $messages);

    if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($request->password);
    }

    if ($request->hasFile('img_path')) {
        $validatedData['img_path'] = $imgPath;
        if ($user->img_path) {
            Storage::disk('public')->delete($user->img_path);
        }
    }

    User::where('id', $user->id)
        ->update($validatedData);

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
        $user = Auth::user();
        $guest = Guest::findOrFail($id);
        $ticket = $user->ticket;

        // Hapus file selfie jika ada
        if ($guest->selfie_path && Storage::disk('public')->exists($guest->selfie_path)) {
            Storage::disk('public')->delete($guest->selfie_path);
        }

        if ($ticket) {
            $ticket->is_used = false;
            $ticket->save();
        }

        $guest->update(['check_out_at' => Carbon::now()]);

        return redirect()->route('admin-main')->with('status', 'Tamu telah dikeluar dan tiket tersedia kembali.');
    }

    public function about()
    {
        return view('about', [
            'title' => 'Halaman Tentang',
            'page' => 'Tentang',
            'judul' => 'Tentang',
            'desc' => '',
            'thumbnail' => 'images/tentang.jpeg',
        ]);
    }
    
    public function info()
    {
        $infos = Info::latest()->get()->all();
        foreach ($infos as $info) {
            $info->formattedDate = Carbon::parse($info->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY');
        }
        return view('info', [
            'title' => 'Halaman Informasi',
            'page' => 'Informasi',
            'judul' => 'Informasi',
            'desc' => '',
            'thumbnail' => 'images/informasi.jpeg',
            'infos' => $infos,
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
