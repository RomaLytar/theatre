<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Auth\UserUpdateRequest;
use App\Models\Country;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = \Auth::user();
        $countries = Country::with('translate')->get();
        $countries = array_multilanguage_formatter($countries, 'id', 'title');
        return view('admin.users.edit', compact('user', 'countries'));
    }

    public function update(UserUpdateRequest $request) {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = \Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }

        $user = \Auth::user();
        $user->update($input);

        return redirect()->back()
            ->with('success', 'Profile updated successfully');
    }
}
