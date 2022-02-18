<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
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
        try {
            //code...
            
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

        } catch (\Exception $th) {
            //throw $th;
            return redirect(route('profile.add'))->with('error','erro ao criar perfil'.$th->getMessage());
            
        }
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
        try {
            //code...
        
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

            } catch (\Exception $th) {
                //throw $th;
                return back()->with('error','erro ao editar perfil'.$th->getMessage());
                
            }
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
