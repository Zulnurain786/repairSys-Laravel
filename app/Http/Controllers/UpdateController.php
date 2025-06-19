<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Update;
use Illuminate\Validation\Rule;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $updates = Update::all();
            return view('admin.updates.list',compact('updates'));
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
        return view('admin.updates.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'version' => 'required|unique:updates',
                'content' => 'required'
            ]);
            $update = new Update;
            $update->version = $request->version;
            $update->content = $request->content;
            if($update->save()) session()->flash('success','Added successfully!');
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
     * Display the specified resource.
     *
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $updates = Update::orderBy('id', 'desc')->get();
        return view('updates',compact('updates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $update = Update::find($id);
            return view('admin.updates.edit',compact('update'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $update = Update::findOrFail($request->id);
            $request->validate([
                'content' => 'required'
            ]);
            $update->content = $request->content;
            if($update->save()) session()->flash('success','Updated successfully!');
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $update = Update::findOrFail($id);
            if($update->delete()) session()->flash('success','Deleted successfully!');
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
