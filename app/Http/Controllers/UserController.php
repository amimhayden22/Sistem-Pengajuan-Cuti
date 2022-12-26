<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, DB, Hash};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role'     => 'required|not_in:0',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect('/dashboard/users')->with('success', 'Data berhasil ditambah...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return abort(404);
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|nullable',
            'email'    => 'required|string|email|max:255:users|nullable',
            'password' => 'nullable|string|min:8',
            'role'     => 'required|not_in:0|nullable',
        ]);

        $user = User::find($id);

        if ($request->input('password')) {
            $updateUser = [
                'name'     => $request->name,
                'password' => Hash::make($request->password),
                'email'    => $request->email,
                'role'     => $request->role,
            ];
        } else {
            $updateUser = [
                'name'   => $request->name,
                'email'  => $request->email,
                'role'   => $request->role,
            ];
        }
        $user->update($updateUser);

        return redirect('/dashboard/users')->with('success', 'Data berhasil diperbarui....');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return abort(404);
        }
        $user->delete();

        return back()->with('success', 'Data berhasil dihapus...');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);

        return view('users.profile', compact('user'));
    }
}
