<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Ticket;
use Carbon\Carbon;



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

        // Dapatkan tiket yang tersedia atau buat yang baru jika tidak ada
        $ticket = Ticket::where('is_used', false)->first();

        if (!$ticket) {
            $lastTicket = Ticket::latest()->first();
            $ticketNumber = $lastTicket ? intval($lastTicket->number) + 1 : 1;
            $ticketNumber = str_pad($ticketNumber, 4, '0', STR_PAD_LEFT);

            $ticket = Ticket::create([
                'number' => $ticketNumber,
            ]);
        }

        $ticket->is_used = true;
        $ticket->save();

        $user = User::create([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'nik' => $request->nik,
            'ket' => $request->ket,
            'ticket_id' => $ticket->id,
            'check_in_at' => Carbon::now(),
        ]);

        // User::create($ValidatedDoc);
        // return redirect('req/{id}');
        // return redirect()->route('req/{id}', $ValidatedDoc);
        // $user = User::create($request->all());
        return redirect()->route('user.ticket', ['id' => $user->id]);
    }

    public function checkOut($id)
    {
        $user = User::findOrFail($id);
        $ticket = $user->ticket;

        if ($ticket) {
            $ticket->is_used = false;
            $ticket->save();
        }

        $user->update(['check_out_at' => Carbon::now()]);

        return redirect()->route('user.index')->with('status', 'Tamu telah keluar dan tiket tersedia kembali.');
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
