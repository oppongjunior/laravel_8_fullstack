<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    //view all users
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('admin.users.users',["users" => $users]);
    }

      //create slider
      public function create(){
        return view('admin.users.adduser');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|max:255|min:8',
        ]);



        //insert
        $user= new User();
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect('user/all')->with("success", "user inserted successfully");
    }

    public function destroy($id){
        if($id != Auth::user()->id){
            User::find($id)->delete();
            return redirect('user/all')->with("success", "user deleted successfully");
        }

        return redirect('user/all')->with("success", "can't delete active user");
    }
}
