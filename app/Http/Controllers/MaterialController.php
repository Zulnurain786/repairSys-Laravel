<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Validation\Rule;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\CompanyMaterial;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try{
            $company_id = !Auth::user()->company ? Auth::user()->id : Auth::user()->company->id;
            $materialsCompany = CompanyMaterial::where('company_id',$company_id)->get();
            $materials = Material::where('repair_id',$id)->with('repair')->get();
            return view('material.list',compact('materials','id','materialsCompany'));
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
            $request->validate([
                'name' => 'required',
                'qty' => 'required',
                'price' => 'required',
            ]);
            $res = false;
            if($request->material=='0') $res = $this->storeCompany($request);
            else $res = true;
            if($res){
                $material = new Material;
                $material->user_id = Auth::user()->id;
                $material->repair_id = $repairId;
                $material->name = $request->name;
                $material->qty = $request->qty;
                $material->price = $request->price;
                if($material->save()) {
                    session()->flash('success','Saved successfully!');
                }
                else session()->flash('error','An error occurred. Please try again.');
                return back();
            }
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /* Store Company Material Also */
    public function storeCompany($request)
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
                return true;
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
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($repairId,$materialId)
    {
        try{
            $material = Material::where('id',$materialId)->with('repair')->first();
            return view('material.edit',compact('material'));
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
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required',
                'qty' => 'required',
                'price' => 'required',
            ]);
            $material = Material::find($request->id);
            $material->user_id = Auth::user()->id;
            $material->name = $request->name;
            $material->qty = $request->qty;
            $material->price = $request->price;
            if($material->save()) {
                session()->flash('success','Saved successfully!');
                // app()->call(HomeController::class.'@sendMailInvoice', ['invoice' => $material->repair->token]);
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
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $material = Material::findOrFail($id);
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
