<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    function getProfile(){

        return view('profile');
    }
    //
function updateProfile(Request $request)
{
    $data = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        // 'address' => $request->input('address'),
        'phone' => $request->input('phone')
    ];

    if (Auth::user()) {
        if ($request->file('profileImage')) {
            if (Auth::user()->profile_photo_path) {
                $oldImage = User::where('id', Auth::user()->id)->first();
                Storage::delete('public/' . $oldImage->profile_photo_path);
            }

            $validator = Validator::make($request->all(), [
                'profileImage' => 'required|image|mimes:jpeg,png|max:2048'
            ], [
                'profileImage.required' => 'Please upload a profile image.',
                'profileImage.image' => 'The uploaded file must be an image.',
                'profileImage.mimes' => 'Only JPEG and PNG images are allowed.',
                'profileImage.max' => 'The image size must not exceed 2MB.'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();

            }

            $imageName = uniqid() . '_' . $request->file('profileImage')->getClientOriginalName();
            $request->file('profileImage')->storeAs('public',$imageName);
            $data['profile_photo_path']=$imageName;

        }
        User::where('id',Auth::user()->id)->update($data);
        // dd($data);
        return back()->with('success', 'Profile updated successfully.');
    }
}

}
