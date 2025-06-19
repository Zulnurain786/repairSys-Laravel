<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            return view('admin.dashboard');
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
            return view('admin.passwords');
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
            return view('admin.settings');
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

     /**
     * companies
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companies()
    {
        try{
            $companies = User::companies()->get();
            return view('admin.companies.list',compact('companies'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }
    

    /**
     * companies Add
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companiesAdd()
    {
        try{
            return view('admin.companies.add');
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * companies Edit
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companiesEdit($id)
    {
        try{
            $company = User::find($id);
            return view('admin.companies.edit',compact('company'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }


    /**
     * Add companies
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companiesSave(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|unique:users',
                'name' => 'required',
                'password' => 'required|string|min:8',
            ]);
            $user = new User;
            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles/'),$imageName);
                $user->profile = asset('uploads/profiles/'.$imageName);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = 2;
            $user->password = Hash::make($request->password);
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
     * Edit companies
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companiesUpdate(Request $request)
    {
        try{
            $user = User::findOrFail($request->id);
            $request->validate([
                'email' => ['required','email',Rule::unique('users')->ignore($user->id)],
                'name' => 'required'
            ]);
            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles/'),$imageName);
                $user->profile = asset('uploads/profiles/'.$imageName);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->password){ 
                $user->password = Hash::make($request->password);
            }
            if($user->save()) session()->flash('success','Updated successfully!');
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
     * Delete companies
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function companiesDelete($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            if($user->trashed()) session()->flash('success','Deleted successfully!');
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
