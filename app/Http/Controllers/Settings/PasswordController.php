<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!\Hash::check($value, $user->password)) {
                        $fail(__('validation.confirmed'));
                    }
                }
            ],
            'password' => 'required|confirmed|min:6|different:old_password',
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);
    }
}
