<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordRequest;
use App\Rules\CurrentPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    public function edit(User $user)
    {
        if(!session()->get('role') && auth()->id() != $user->id){
            abort('403', 'You do not have sufficient permission');
        }
        return view('user-password.edit', compact('user'));
    }

    public function update(User $user, UserPasswordRequest $request)
    {
        if(!session()->get('role') && auth()->id() != $user->id){
            abort('403', 'You do not have sufficient permission (तपाईंसँग पर्याप्त अनुमति छैन)');
        }

        $input = [];

        if (!isset($request->is_admin_changed)) {
            $request->validate([
                'old_password' => ['required', new CurrentPassword(), ],
                'password' => 'different:old_password'
            ], [
                'password.different' => 'New password should be different than current password'
            ]);
        }

        $input['password'] = Hash::make($request->password); //Hash password
        $user->update($input); //Create User table entry

        return redirect()->route('user.index')
            ->with('flash', ['status' => true, 'statusMessage' => 'Password updated successfully']);

    }
}
