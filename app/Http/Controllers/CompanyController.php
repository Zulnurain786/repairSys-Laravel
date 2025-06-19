<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Repair;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Material;

class CompanyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            return view('company.dashboard');
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
            return view('company.passwords');
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
            return view('company.settings');
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
     * users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        try{
            $users = User::companyUsers()->where('company_id',Auth::user()->id)->get();
            return view('company.users.list',compact('users'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }
    

    /**
     * users Add
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usersAdd()
    {
        try{
            return view('company.users.add');
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * users Edit
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usersEdit($id)
    {
        try{
            $user = User::find($id);
            return view('company.users.edit',compact('user'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }


    /**
     * Add users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usersSave(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|unique:users',
                'name' => 'required',
                'password' => 'required|string|min:8',
                'type' => 'required'
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
            $user->role_id = (int)$request->type;
            $user->company_id = Auth::user()->id;
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
     * Edit users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usersUpdate(Request $request)
    {
        try{
            $user = User::findOrFail($request->id);
            $request->validate([
                'email' => ['required','email',Rule::unique('users')->ignore($user->id)],
                'name' => 'required',
                'type' => 'required'
            ]);
            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles/'),$imageName);
                $user->profile = asset('uploads/profiles/'.$imageName);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = (int)$request->type;
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
     * Delete users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usersDelete($id)
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

    /* Labour Report */
    public function labourReport(Request $request){
        try{
            $company_id = Auth::user()->id;
            $status = ['Paid', 'Completed', 'Collected'];
            $reports = Repair::where('company_id',$company_id)->whereIn('status', $status);
            if($request->from && $request->to){
                $startDate = Carbon::createFromFormat('d M, Y', $request->from)->startOfDay();
                $endDate = Carbon::createFromFormat('d M, Y', $request->to)->endOfDay();
                $reports = $reports->whereBetween('created_at', [$startDate, $endDate]);
            }
            $reports = $reports->get();
            return view('reports.labour',compact('reports'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /* Material Report */
    public function materialReport(Request $request){
        try{

            $users = User::where('company_id',Auth::user()->id)->orWhere('id',Auth::user()->id)->pluck('id');
            $material = Material::whereIn('user_id', $users);
            if($request->from && $request->to){
                $startDate = Carbon::createFromFormat('d M, Y', $request->from)->startOfDay();
                $endDate = Carbon::createFromFormat('d M, Y', $request->to)->endOfDay();
                $material = $material->whereBetween('created_at', [$startDate, $endDate]);
            }
            $material = $material->with('repair')->get();
            return view('reports.material',compact('material'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }
}
