<?php

namespace App\Http\Controllers\Eksternal;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ProfileUpdateController extends Controller
{
    public function index(): View {
        $titles = 'Update Profile';
        $eksternal = auth()->guard('ekt')->user();
        return view('eksternal.profile.create',compact('titles', 'eksternal'));
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

        $eksternal = auth()->guard('ekt')->user();
        if($imagePath) $eksternal->image = $imagePath;
        $eksternal->name = $request->name;
        $eksternal->email = $request->email;
        // tell PHP intelephense that $user variable is not Illuminate\Foundation\Auth\User but \App\Models\User
        // /** @var \App\Models\User $user **/
        /** @var \App\Models\User $eksternal **/
        $eksternal->save();

        toast('Update profile berhasil!','success');

        return redirect()->back();
    }

    function passwordUpdate(Request $request) : RedirectResponse {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $eksternal = auth()->guard('ekt')->user();
        $eksternal->password = bcrypt($request->password);
        /** @var \App\Models\User $eksternal **/
        $eksternal->save();

        toast('Update password berhasil!','success');

        return redirect()->back();
    }
}
