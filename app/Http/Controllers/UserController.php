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
        $request->validate([
            'email'         => ['required', 'unique:users,email','email', 'regex:/^.+@.\.\w+$/i'],
            'staffId'       => ['required', 'unique:users,staffId'],
            'password'      => ['required', 'min:6'],
            'staffName'     => ['required'],
            'departureName' => ['required'],
            'position'      => ['required'],
            'currency'      => ['required'],
            'salary'        => ['required','numeric'],
            'phoneNumber'   => ['required'],
            'resume'        => ['file', 'max:5120 ', 'required', 'mimes:pdf']
        ],[
            'email.required'            => 'Mohon masukkan field Email',
            'email.unique'              => 'Email telah digunakan',
            'email.email'               => 'Masukkan email dengan benar',
            'email.regex'               => 'Masukkan email dengan benar',
            'password.required'         => 'Mohon masukkan field password',
            'password.min'              => 'Jumlah karakter password harus lebih dari 6',
            'staffId.required'          => 'Mohon masukkan field Staff Id',
            'staffId.unique'            => 'Staff Id telah digunakan',
            'password.required'         => 'Mohon masukkan field password',
            'staffName.required'        => 'Mohon masukkan field Staff Name',
            'departureName.required'    => 'Mohon masukkan field departureName',
            'position.required'         => 'Mohon masukkan field position',
            'currency.required'         => 'Mohon masukkan field currency',
            'salary.required'           => 'Mohon masukkan field salary',
            'salary.numeric'            => 'Field salary berupa angka',
            'phoneNumber.required'      => 'Mohon masukkan field Phone Number',
            'resume.file'               => 'Masukkan file dengan type .pdf',
            'resume.mimes'              => 'Masukkan file dengan type .pdf',
            'resume.max'                => 'Maksimum file 5120  KB',
            'resume.required'           => 'Mohon masukkan resume'
        ]);

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
                'phoneNumber'       => $request->get('phoneNumber'),
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

    public function Update(Request $request, $id){
        $request->validate([
            'email'         => ['required', 'unique:users,email,'.$id,'email', 'regex:/^.+@.\.\w+$/i'],
            'staffId'       => ['required', 'unique:users,staffId,'.$id,],
            'staffName'     => ['required'],
            'departureName' => ['required'],
            'position'      => ['required'],
            'currency'      => ['required'],
            'salary'        => ['required','numeric'],
            'phoneNumber'   => ['required'],
        ],[
            'email.required'            => 'Mohon masukkan field Email',
            'email.unique'              => 'Email telah digunakan',
            'email.email'               => 'Masukkan email dengan benar',
            'email.regex'               => 'Masukkan email dengan benar',
            'staffId.required'      => 'Mohon masukkan field Staff Id',
            'staffId.unique'        => 'Staff Id telah digunakan',
            'staffName.required'     => 'Mohon masukkan field Staff Name',
            'departureName.required'     => 'Mohon masukkan field departureName',
            'position.required'     => 'Mohon masukkan field position',
            'currency.required'     => 'Mohon masukkan field currency',
            'salary.required'     => 'Mohon masukkan field salary',
            'salary.numeric'     => 'Field salary berupa angka',
            'phoneNumber.required'     => 'Mohon masukkan field Phone Number',
        ]);

        User::where('id', $id)->update(
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
            ]
        );

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('users.index');
    }
}
