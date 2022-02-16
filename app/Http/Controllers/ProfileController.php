<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */

    public function add()
    {
        return view('profile.create');
    }

    public function create(ProfileRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->job = $request->job;
        $user->password = Hash::make($request->password);
        $user->description = $request->description;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->gmail = $request->gmail;

        if($request->hasFile('foto') && $request->file('foto')->isValid())
        {
            $requestImage = $request->foto;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtolower('now')). "." . $extension;

            $requestImage->move(public_path('img/profile'),$imageName);
            $user->image = $imageName;
        }
        // var_dump($request->hasFile('foto'));
        // var_dump($request->foto);
        $user->save();
        return redirect(route('profile.add'))->withStatus(__('Profile successfully criado.'));
    }

    public function editAll()
    {
        return view('profile.editAll');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $data = $request->all();
        
        if($request->hasFile('foto') && $request->file('foto')->isValid())
        {
            $requestImage = $request->foto;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtolower('now')). "." . $extension;

            $requestImage->move(public_path('img/profile'),$imageName);
            $data['image'] = $imageName;
            
        }

        auth()->user()->update($data);

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
