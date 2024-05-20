<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome',[
            'title' => 'Selamat Datang'
        ]);
    }

    public function ticket(Request $request)
    {
        return view('postreq', [
            'title' => 'Ticket Tamu',
            'nama' => $request->nama,
            'tlp' => $request->tlp
        ]);
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
        $ValidatedDoc = $request->validate([
            'nama' => 'required',
            'telp' => 'required',
            'nik' => ['required', 'numeric', ],
            'ket' => 'required',
        ]);
        dd($ValidatedDoc);
        User::create($ValidatedDoc);
        // return redirect('req/');
        // return redirect()->route('req/{id}', $ValidatedDoc);
        return redirect()->route('req/', ['nama' => $request->nama, 'telp' => $request->telp]);
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
        //
    }
}
