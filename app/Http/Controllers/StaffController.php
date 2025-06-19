<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            return view('staff.dashboard');
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

        /**
     * Passwords
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function passwords()
    {
        try{
            return view('staff.passwords');
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * settings
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        try{
            return view('staff.settings');
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * Upload Profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function uploadProfile(Request $request)
    {
        try{
            $user = Auth::user();
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles/'),$imageName);
                $user->profile = asset('uploads/profiles/'.$imageName);
                $user->save();
                return asset('uploads/profiles/'.$imageName);
            }
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * Save Profile Data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function uploadProfileData(Request $request)
    {
        try{
            $user = Auth::user();
            $user->name = $request->name;
            if($user->save()) session()->flash('success','Saved successfully!');
            else session()->flash('error','An error occurred. Please try again.');
            return back();
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * Change Passwords
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function passwordsSave(Request $request)
    {
        try{
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
            ]);
            $user = Auth::user();
            /* Check if the current password matches the user's stored password */
            if (!Hash::check($request->current_password, $user->password)) {
                session()->flash('error','The current password is incorrect.');
                return back();
            }
            /* Update the user's password */
            $user->password = Hash::make($request->new_password);
            if($user->save()) session()->flash('success','Saved successfully!');
            else session()->flash('error','An error occurred. Please try again.');
            return back();
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }
}
