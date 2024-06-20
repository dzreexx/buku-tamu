<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\News;
use App\Models\Info;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
    return view('admin-main', [
        'title' => 'Halaman Admin',
        'page' => 'Kunjungan',
    ]);
}

public function tamu()
{
    $guest = Guest::latest()->get()->all();
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

public function getNewUsers(Request $request)
{
    $newUsers = User::where('is_admin', null)->get();

    return response()->json($newUsers);
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
    // $userNew = User::where('is_admin', null)->latest()->get();
    return view('admin-user', [
        'title' => 'Halaman Daftar Pengguna',
        'page' => 'Kelola Pengguna',
        'users' => $user,
        // 'newUsers' => $userNew,
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
        $news = News::latest()->get()->all();
        return view('admin-news',[
            'title' => 'Kelola Berita',
            'page' => 'Kelola Berita',
            'news' => $news,
        ]);
    }

    public function newsSearch(Request $request)
    {
        $output = "";
    
        $news = News::where('judul', 'like', '%' . $request->search . '%')
        ->orWhere('excerpt', 'like', '%' . $request->search . '%')
        ->orWhere('body', 'like', '%' . $request->search . '%')
        ->orWhere('created_at', 'like', '%' . $request->search . '%')
        ->get();
    
        foreach ($news as $index => $new) {
            $output .= '<tr>
                <th>'.($index + 1).'</th>
                <th>'.$new->judul.'</th>
                <th>'.$new->excerpt.'</th>
                <th>'.\Carbon\Carbon::parse($new->created_at)->locale('id')->translatedFormat('d F Y').'</th>
                <th><a href="/admin/berita/'.$new->id.'">Lihat</a></th>
                <th>
                    <button type="button" class="btn btn-error" onclick="showDeleteModal('.$new->id.')">Hapus</button>
                </th>
            </tr>';
        }
        return response($output);
    }
    
    public function newsDestroy($id)
    {
        $news = News::findOrFail($id);
        // Hapus gambar profil dari storage jika ada
        if ($news->thumb_path) {
            Storage::delete($news->thumb_path);
        }

        // Hapus user dari database
        $news->delete();

        // Redirect atau memberikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->route('news')->with('success', 'Berita Berhasil di Hapus.');
    }

    public function newsDetail($id)
    {
        $news = News::findOrFail($id);
        return view('news-detail',[
            'title' => 'Detail Berita',
            'page' => 'Detail Berita',
            'news' => $news,
        ]);
    }

    public function newsUpdate($id)
    {
        $news = News::findOrFail($id);
        return view('admin-update-news',[
            'title' => 'Ubah Berita',
            'page' => 'Rubah Berita',
            'news' => $news,
        ]);
    }
    public function newsUpdateStore(Request $request,$id)
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
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'body' => 'required',
        ],$messages);

        $news = News::findOrFail($id);

        $news->judul = $request->judul;
        $news->body = $request->body;
        
        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama jika ada
            if ($news->thumb_path) {
                Storage::disk('public')->delete($news->thumb_path);
            }
            // Simpan foto baru
            $imgPath = $request->file('thumbnail')->store('thumbnail', 'public');
            $news->thumb_path = $imgPath;
        }

        $news->save();

        return redirect()->route('news')->with('success', 'Berita berhasil diperbarui.');

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

        $user = Auth::user();

        $news = News::create([
            'judul' => $validateDoc['judul'],
            'thumb_path' => $imagePath,
            'body' => $validateDoc['body'],
            'excerpt' => Str::limit(strip_tags($request->body), 50),
            'user_id' => $user->id,
        ]);

        return redirect()->route('news')->with('success', 'Berita berhasi ditambahkan.');

    }

public function info()
{
    $info = Info::latest()->get()->all();
    return view('admin-info',[
        'title' => 'Halaman Informasi',
        'page' => 'Kelola Informasi',
        'infos' => $info,
    ]);
}

public function infoSearch(Request $request)
{
    $output = "";

    $infos = Info::where('nama', 'like', '%' . $request->search . '%')
    ->orWhere('lokasi', 'like', '%' . $request->search . '%')
    ->orWhere('tanggal', 'like', '%' . $request->search . '%')
    ->orWhere('ket', 'like', '%' . $request->search . '%')
    ->get();

    foreach ($infos as $index => $info) {
        $output .= '<tr>
            <th>' . ($index + 1) . '</th>
            <th>' . $info->nama . '</th>
            <th>' . $info->ket . '</th>
            <th>' . $info->lokasi . '</th>
            <th>' . \Carbon\Carbon::parse($info->tanggal)->locale('id')->translatedFormat('d F Y') . '</th>
            <th><a href="/admin/informasi/' . $info->id . '/ubah" class="btn btn-info">Ubah</a></th>
            <th>
                <form action="/admin/informasi/' . $info->id . '/hapus" method="POST" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus informasi ini?\')">
                    ' . method_field('DELETE') . csrf_field() . '
                    <button type="submit" class="btn btn-error">Hapus</button>
                </form>
            </th>
        </tr>';
    }

    return response($output);
}


// public function infoDetail($id)
// {
//     $info = Info::findOrFail($id);
//     return view('info-detail',[
//         'title' => 'Halaman Informasi',
//         'page' => 'Informasi',
//         'info' => $info,
//     ]);
// }
public function infoCreate()
{
    return view('admin-create-info',[
        'title' => 'Halaman Buat Pengumuman',
        'page' => 'Buat Pengumuman',
    ]);
}

public function infoUpdate($id)
{
    $info = Info::findOrFail($id);
    return view('admin-update-info',[
        'title' => 'Rubah Pengumuman',
        'page' => 'Rubah Pengumuman',
        'info' => $info,
    ]);
}

public function infoDestroy($id)
{
    $info = Info::findOrFail($id);

        $info->delete();

        return redirect()->route('info')->with('success', 'Informasi Berhasil di Hapus.');
}

public function infoStoreUpdate(Request $request, $id)
{

    $messages = [
        'nama.required' =>'Nama acara harus diisi.',
        'nama.max' =>'Nama maksimal 50 karakter.',
        'nama.min' =>'Nama minimal 5 karakter.',
        'lokasi.required' =>'Lokasi harus diisi.',
        'lokasi.max' =>'Lokasi maksimal 255 karakter.',
        'lokasi.min' =>'Lokasi minimal 5 karakter.',
        'tanggal.required' =>'Tanggal harus diisi.',
        'tanggal.date' =>'Tanggal harus berupa tanggal.',
        'ket.required' =>'Keterangan harus diisi.',
    ];
    $validatedDoc = $request->validate([
        'nama' => 'required|max:50|min:5',
        'lokasi' => 'required|max:255|min:5',
        'tanggal' => 'required|date',
        'ket' => 'required',
    ],$messages);

    $info = Info::findOrFail($id);

    $info->nama = $request->nama;
    $info->lokasi = $request->lokasi;
    $info->tanggal = $request->tanggal;
    $info->ket = $request->ket;

    $info->save();

    return redirect()->route('info')->with('success', 'Informasi berhasi diperbarui.');
}

public function infoStore(Request $request)
{
    
    $messages = [
        'nama.required' =>'Nama acara harus diisi.',
        'nama.max' =>'Nama maksimal 50 karakter.',
        'nama.min' =>'Nama minimal 5 karakter.',
        'lokasi.required' =>'Lokasi harus diisi.',
        'lokasi.max' =>'Lokasi maksimal 255 karakter.',
        'lokasi.min' =>'Lokasi minimal 5 karakter.',
        'tanggal.required' =>'Tanggal harus diisi.',
        'tanggal.date' =>'Tanggal harus berupa tanggal.',
        'ket.required' =>'Keterangan harus diisi.',
    ];

    $validateDoc = $request->validate([
        'nama' => 'required|max:50|min:5',
        'lokasi' => 'required|max:255|min:5',
        'tanggal' => 'required|date',
        'ket' => 'required',
    ],$messages);

    Info::create($validateDoc);

    return redirect()->route('info', ['Success' => 'Informasi berhasi ditambahkan.']);
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

// public function test()
// {

//     return view('test-livewire',[
//         'title' => 'Halaman Testing',
//         'page' => 'Testing',
//     ]);
// }
    }
