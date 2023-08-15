<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index',[
            'data' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.form',[
            'role' => ['admin','staff']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required'
        ],[],[
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi Password',
            'role' => 'Role'
        ]);
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect()->route('users.index')->with('success','Berhasil Tambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show',[
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.form',[
            'role' => ['admin','staff'],
            'edit' => true,
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'role' => 'required'
        ],[],[
            'name' => 'Nama',
            'email' => 'Email',
            'role' => 'Role'
        ]);
        if(!empty($request->password)) {
            $request->validate([
                'password' => 'required|confirmed',
                'password_confirmation' => 'required|confirmed',
            ],[],[
                'password' => 'Password',
                'password_confirmation' => 'Konfirmasi Password',
            ]);
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success','Berhasil Update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
