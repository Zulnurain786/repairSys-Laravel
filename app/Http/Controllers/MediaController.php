<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Repair;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try{
            $media = Media::where('repair_id',$id)->with('repair')->get();
            return view('media.list',compact('media','id'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$repairId)
    {
        try{
            if($request->hasFile('file')){
                $image = $request->file('file');
                // dd($image);
                $media = new Media;
                $imageName = \Str::random(4).time().'.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/repair/'),$imageName);
                $media->repair_id = $repairId;
                $media->path = asset('uploads/repair/'.$imageName);
                $media->save();
                return true;
            }
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $media = Media::findOrFail($id);
            if( $media->delete()) session()->flash('success','Deleted successfully!');
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
