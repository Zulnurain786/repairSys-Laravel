<?php

namespace App\Http\Controllers;

use App\Models\CompanyMaterial;
use App\Models\Material;
use Illuminate\Validation\Rule;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $company_id = !Auth::user()->company ? Auth::user()->id : Auth::user()->company->id;
            $materials = CompanyMaterial::where('company_id',$company_id)->get();
            return view('allMaterials.list',compact('materials','company_id'));
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
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => ['required','unique:company_materials'],
                'price' => 'required',
            ]);
            $material = new CompanyMaterial;
            $material->company_id = !Auth::user()->company ? Auth::user()->id : Auth::user()->company->id;
            $material->name = $request->name;
            $material->price = $request->price;
            if($material->save()) {
                session()->flash('success','Saved successfully!');
            }
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
     * @param  \App\Models\CompanyMaterial  $companyMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyMaterial $companyMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyMaterial  $companyMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyMaterial $companyMaterial,$materialId)
    {
        try{
            $material = CompanyMaterial::where('id',$materialId)->first();
            return view('allMaterials.edit',compact('material'));
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
     * @param  \App\Models\CompanyMaterial  $companyMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $material = CompanyMaterial::findOrFail($request->id);
            $request->validate([
                'name' => ['required', Rule::unique('company_materials')->ignore($material)],
                'price' => 'required',
            ]);
            $material->company_id = !Auth::user()->company ? Auth::user()->id : Auth::user()->company->id;
            $material->name = $request->name;
            $material->price = $request->price;
            if($material->save()) {
                session()->flash('success','Saved successfully!');
            }
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
     * @param  \App\Models\CompanyMaterial  $companyMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $material = CompanyMaterial::findOrFail($id);
            if($material->delete()) session()->flash('success','Deleted successfully!');
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
