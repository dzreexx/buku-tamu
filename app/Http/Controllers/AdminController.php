<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\News;
use App\Models\Guest;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-login',[
            'title' => 'Login Admin',
        ]);
    }

    public function main()
{
    $today = Carbon::today();

    $guest = Guest::where('check_out_at', null)->get();
    $today = Guest::whereDate('check_in_at', $today)->get();
    
    // Ambil data pengunjung berdasarkan tahun dan bulan dari tanggal check-in
    $visitors = Guest::selectRaw('YEAR(check_in_at) as year, MONTH(check_in_at) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    // Memisahkan data menjadi label dan dataset
    $labels = $visitors->map(function ($item) {
        // Mengonversi nomor bulan menjadi nama bulan
        $monthName = Carbon::create()->month($item->month)->format('F');
        return $monthName . ' ' . $item->year;
    })->toArray();
    
    $data = $visitors->pluck('count')->toArray();

    return view('admin-main', [
        'title' => 'Halaman Admin',
        'page' => 'Kunjungan',
        'guests' => $guest,
        'todays' => $today,
    ],compact('labels', 'data'));
}

public function tamu()
{
    $guest = Guest::get()->all();
    return view('admin-guest', [
        'title' => 'Halaman Tamu',
        'page' => 'Tamu',
        'guests' => $guest,
    ]);
}

public function guestSearch(Request $request)
{
    $output = "";

    $guests = Guest::where('nama', 'Like', '%' . $request->search . '%')
        ->orWhere('ket', 'Like', '%' . $request->search . '%')
        ->orWhere('telp', 'Like', '%' . $request->search . '%')
        ->orWhere('nik', 'Like', '%' . $request->search . '%')
        ->orWhere('check_in_at', 'Like', '%' . $request->search . '%')
        ->orWhere('check_out_at', 'Like', '%' . $request->search . '%')
        ->get();

    foreach ($guests as $index => $guest) {
        $output .= '
        <tr>
            <th>' . ($index + 1) . '</th>
            <td>' . $guest->nama . '</td>
            <td>' . $guest->ket . '</td>
            <td>0' . $guest->telp . '</td>
            <td>' . $guest->nik . '</td>
            <td>' . ($guest->created_at instanceof \Carbon\Carbon ? $guest->created_at->format('Y-m-d') : $guest->created_at) . '</td>
            <td>' . ($guest->check_in_at instanceof \Carbon\Carbon ? $guest->check_in_at->format('H:i') : \Illuminate\Support\Str::after($guest->check_in_at, ' ')) . '</td>
            <td>' . ($guest->check_out_at instanceof \Carbon\Carbon ? $guest->check_out_at->format('H:i') : \Illuminate\Support\Str::after($guest->check_out_at, ' ')) . '</td>
        </tr>';
    }

    return response($output);
}

public function userSearch(Request $request)
{
    $output = "";

    $users = User::where('is_admin', false)
        ->where(function($query) use ($request) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('created_at', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('telp', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('nik', 'LIKE', '%' . $request->search . '%');
        })
        ->get();

    foreach ($users as $index => $user) {
        $output.='<tr>
        <th>
          <label>
            '.($index + 1).'
          </label>
        </th>
        <td>
          <div class="flex items-center gap-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img src="'.asset("storage/".$user->img_path ) .'" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">'.$user->nama.'</div>
              <div class="text-sm opacity-50">'.$user->email.'</div>
            </div>
          </div>
        </td>
        <td>
          '.$user->nik.'
          <br/>
        </td>
        <td>0'.$user->telp.'</td>
        <th>
          <button 
            class="btn btn-ghost btn-xs" 
            data-id="'.$user->id.'" 
            data-nama="'.$user->nama.'" 
            data-nik="'.$user->nik.'" 
            data-telp="0'.$user->telp.'" 
            data-email="'.$user->email.'" 
            data-buat="'.$user->created_at.'" 
            data-img="'.asset("storage/".$user->img_path ).'" 
            onclick="openModal(this)">details</button>
        </th>
      </tr>';
    }
    return response($output);

}

public function user()
{
    $user = User::where('is_admin', false)->get();
    $userNew = User::where('is_admin', null)->latest()->get();
    return view('admin-user', [
        'title' => 'Halaman Daftar Pengguna',
        'page' => 'Kelola Pengguna',
        'users' => $user,
        'newUsers' => $userNew,
    ]);
}

public function verify(Request $request, User $user)
    {

            $user->is_admin = $request->input('is_admin');
            $user->save();

            return redirect()->back()->with('success', 'User updated successfully.');

        // return redirect()->back()->with('error', 'User not found.');
    }


    public function news()
    {
        $news = News::get()->all();
        return view('admin-news',[
            'title' => 'Kelola Berita',
            'page' => 'Kelola Berita',
            'news' => $news,
        ]);
    }

    public function newsCreate()
    {
        return view('admin-create-news',[
            'title' => 'Halama Buat Berita',
            'page' => 'Buat Berita',
        ]);
    }

    public function storeNews(Request $request)
    {
        $messages = [
            'judul.required' => 'Judul Harus Diisi.',
            'judul.max' => 'Judul max 255.',
            'thumbnail.required' => 'Sampul Harus diisi.',
            'thumbnail.image' => 'Sampul harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpeg,png,jpg,gif.',
            'thumbnail.max' => 'Sampul maksimal 2MB.',
            'body.required' => 'Isi Harus ada.',
        ];

        $validateDoc = $request->validate([
            'judul' => 'required|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'body' => 'required',
        ], $messages);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('thumbnails', $imageName, 'public');
        }

        $news = News::create([
            'judul' => $validateDoc['judul'],
            'thumb_path' => $imagePath,
            'body' => $validateDoc['body'],
            'excerpt' => Str::limit(strip_tags($request->body), 50),
        ]);

        return redirect()->route('news')->with('success', 'Berita berhasi ditambahkan.');

    }

public function info()
{
    return view('admin-info',[
        'title' => 'Halaman Informasi',
        'page' => 'Informasi',
    ]);
}

public function show($id)
{
    
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
