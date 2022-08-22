<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function Index(){
        $users = User::where('role',2)->get();
        return view('pages.users',compact('users'));
    }

    public function Create(){
        return view('pages.usersCreate');
    }

    public function Store(Request $request){
        $resume = $request->file('resume');
        $path = 'public/resume/' . $request->get('name') . '/';
        $store = $resume->storeAs($path, $resume->getClientOriginalName());
        $link = $request->root() . '/storage/resume/' . $request->get('name') . '/' . $resume->getClientOriginalName();
        $resume = Storage::url($store);
        $resume = $request->root() . $resume;

        // dd($request->all());
        User::create(
            [
                'email'             => $request->get('email'),
                'password'          => bcrypt($request->get('password')),
                'staffId'           => $request->get('staffId'),
                'staffName'         => $request->get('staffName'),
                'departureName'     => $request->get('departureName'),
                'position'          => $request->get('position'),
                'currency'          => $request->get('currency'),
                'salary'            => $request->get('salary'),
                'phoneNumber'            => $request->get('phoneNumber'),
                'role'              => 2,
                'resume'            => $link
            ]
        );

        return view('pages.usersCreate');
    }

    public function Edit($id){
        $user = User::where('id', $id)->first();
        return view('pages.usersEdit',compact('user'));
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('users.index');
    }
}
