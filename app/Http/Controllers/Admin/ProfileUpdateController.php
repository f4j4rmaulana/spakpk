<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileUpdateController extends Controller
{
    public function index(): View {
        $titles = 'Update Profile';
        $admin = auth()->guard('admin')->user();
        return view('admin.profile.create',compact('titles', 'admin'));
    }

    function uploadFile(Request $request, string $inputName, ?string $oldPath = null, string $path = '/gambar/pengguna' ) : String
    {
       if($request->hasFile($inputName)) {
            $file = $request->{$inputName};
            $ext = $file->getClientOriginalExtension();
            $fileName = 'media_'.uniqid().'.'.$ext;

            $file->move(public_path($path), $fileName);

            return $path . '/' . $fileName;
       }

       return '';
    }

    public function update(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'min:3'],
            'image' => ['nullable', 'max:2000', 'image', 'mimes:jpg,png'],
            'email' => ['required', 'email']
        ]);

        $imagePath = $this->uploadFile($request, 'image');

        $admin = auth()->guard('admin')->user();
        if($imagePath) $admin->image = $imagePath;
        $admin->name = $request->name;
        $admin->email = $request->email;
        // tell PHP intelephense that $user variable is not Illuminate\Foundation\Auth\User but \App\Models\User
        // /** @var \App\Models\User $user **/
        /** @var \App\Models\Admin $admin **/
        $admin->save();

        toast('Update profile berhasil!','success');

        return redirect()->back();
    }

    function passwordUpdate(Request $request) : RedirectResponse {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $admin = auth()->guard('admin')->user();
        $admin->password = bcrypt($request->password);
        /** @var \App\Models\Admin $admin **/
        $admin->save();

        toast('Update password berhasil!','success');

        return redirect()->back();
    }
}
