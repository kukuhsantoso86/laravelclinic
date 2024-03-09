<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){

        $users = DB::table('users')
    	->when($request->input('name'), function ($query, $name) {
    		return $query->where('name', 'like', '%'.$name.'%');
    	})
        ->orderBy('id','desc')
    	->paginate(5);
    	return view('pages.users.index', compact('users'));
    }

    public function create(){
    	return view('pages.users.create');
    }

    public function store(Request $request){

    	$request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'user created successfully');
    }

    public function show($id){

        $user = User::find($id);
        return view('pages.users.show', compact('user'));
    }

    public function edit($id){
    	$user = User::find($id);
    	return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id){

    	$request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'user updated successfully');
    }

    public function destroy($id){

    	$user = User::find($id);
    	$user->delete();
    	return redirect()->route('users.index')->with('success', 'user deleted successfully');
    }
}
