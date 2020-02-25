<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserAvatarController extends Controller
{
    public function store(Request $request)
    {
        // validate the image
        $this->validate($request, [
            'avatar' => 'required|image|max:2000'
        ]);

        // get the user
        $user = auth()->user();

        // upload and resize using Intervention Image 
        $filename = 'uploads/avatar-'.$user->id.'.jpg';

        Image::make($request->file('avatar'))
            ->fit(200, 200)
            ->save($filename, 80);

        // update model
        $user = auth()->user();
        $oldAvatar = $user->avatar;
        $user->update(['avatar' => $filename]);

        // delete old image
        unlink($oldAvatar);

        return [
            'avatar' => asset($filename)
        ];
    }
}