<?php

// namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Hash;
// use Illuminate\Http\Request;

// class ChangeController extends Controller
// // {
//     public function change_password()
//     {
//         return view('change');
//     }

//     public function update_password(Request $request)
//     {
//         request()->validate(
//             [
//                 'old_password' => 'required',
//                 'password' => ['required', 'string', 'min:8', 'confirmed'],
//             ]
//         );

//         $currentPassword = auth()->user()->password;
//         $old_password = request('old_passowrd');

        // if (Hash::check($old_password, $currentPassword)) {
        //     auth()->user()->update([
        //         'password' => request('password')
        //     ]);
        //     return back()->with('success', 'you are change your password');
        // } else {
        //     return back()->withErrors('old_password', 'Make sure you fill your currentPassword');
        // }
//     }
// }
