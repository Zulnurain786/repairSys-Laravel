<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Repair;
use App\Models\User;
use App\Models\ExtraFields;
use App\Models\extrafieldvalues;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

class RepairController extends Controller
{
    /* Repairs */
    public function index(Request $request){
        try{
            $company_id = Auth::user()->role_id==2 ? Auth::user()->id : Auth::user()->company->id;
            $repairs = Repair::where('company_id',$company_id);
            $allRepair =  Repair::where('company_id',$company_id)->get();
            if($request->status){
                $repairs = $repairs->where('status',$request->status);
            }
            $repairs = $repairs->get();
            return view('repairs.list',compact('repairs','allRepair'));
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /* Create */
    public function create(){
        try{
            $company_id = Auth::user()->role_id==2 ? Auth::user()->id : Auth::user()->company->id;
            $extrafields = ExtraFields::where('compnyID', $company_id)->get();
            $data = [];
           
            foreach ($extrafields as $item) {
                $decodedData = json_decode($item->key, true);
                // Merge the decoded data into the $data array
                $data = array_merge($data, $decodedData);
            }
            return view('repairs.add',['data' => $data]);

        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }
    /* felds */
    public function fields(){
        try{
         
            return view('repairs.fields');
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /* Save */
    public function filedssave(Request $request){
        try{
            $jsonData = [];

            // Loop through all input fields and build the JSON structure
            foreach ($request->all() as $key => $value) {
                // Exclude the _token and other fields if needed
                if ($key !== '_token') {
                    $jsonData[$key] = $value;
                }
            }
            $extrafields = new ExtraFields;
            $extrafields->compnyID = Auth::user()->role_id==2 ? Auth::user()->id : Auth::user()->company_id;
            $extrafields->key=json_encode($jsonData);
            

            if($extrafields->save()){
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


    public function save(Request $request){
        $result=false;
        try{
            $request->validate([
                'name' => 'required',
            ]);
            $company_id = Auth::user()->role_id==2 ? Auth::user()->id : Auth::user()->company_id;
            $repair = new Repair;
            $repair->company_id = $company_id;
            $repair->created_by = Auth::user()->id;
            $repair->token = \Str::random(2).date('Y').date('d').date('m').\Str::random(2);
            $repair->name = $request->name;
            $repair->phone = $request->phone;
            $repair->email = $request->email;
            $repair->brand = $request->brand;
            $repair->color = $request->color;
            $repair->type = $request->type;
            $repair->prior_work = $request->prior_work;
            $repair->accessories = $request->accessories;
            $repair->work_requested = $request->work_requested;
            $repair->warranty = $request->warranty;
            $repair->note = $request->note;
            if($repair->save()){
                $result=true;
            }
            // extra-fields-entry-start
            $inputData = $request->all();
            $excludedInputNames = ['name', 'phone','email','brand','color','type','prior_work','accessories','work_requested','warranty','note','_token']; // Add the names you want to exclude
            $extrafields = new extrafieldvalues;
            $extrafields->compnyID=$company_id;
            $extrafields->repairID=$repair->id;
            $jsonData=[];
            foreach ($inputData as $key => $value) {
                if (!in_array($key, $excludedInputNames)) {
                     $jsonData[$key]=$value;
                    
                }
            }
            $extrafields->keyNvalues=json_encode($jsonData);
            $extrafields->save();
            // extra-fields-entry-end

            if($result){
                session()->flash('success','Saved successfully!');
                app()->call(HomeController::class.'@sendMailInvoice', ['invoice' => $repair->token]);
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

    /* Edit */
    public function edit($id){
        try{
            $repair = Repair::find($id);
            $exFields = extrafieldvalues::where('repairID', $id)->first();
            if(empty($exFields)) {
                return view('repairs.edit',compact('repair'));
            } else {
                $data=json_decode($exFields->keyNvalues);
                return view('repairs.editExtrafields',compact('repair','data'));
            }
           
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /* Update */
    public function update(Request $request){
        try{
            $request->validate([
                'name' => 'required',
            ]);
            $repair = Repair::find($request->id);
            $email = $request->status==$repair->status ? false : true;
            $repair->name = $request->name;
            $repair->status = $request->status;
            $repair->updated_by = Auth::user()->id;
            $repair->phone = $request->phone;
            $repair->email = $request->email;
            $repair->brand = $request->brand;
            $repair->color = $request->color;
            $repair->type = $request->type;
            $repair->prior_work = $request->prior_work;
            $repair->accessories = $request->accessories;
            $repair->work_requested = $request->work_requested;
            $repair->warranty = $request->warranty;
            $repair->note = $request->note;
            $repair->hours = $request->hours;
            $repair->hour_rate = $request->hour_rate;
            $repair->technician_notes = $request->technician_notes;

             //extra-fields-entry-start
             
                $inputData = $request->all();
                $exFields = extrafieldvalues::where('repairID',$request->id)->first();
                $excludedInputNames = ['id','status','name','technician_notes','hours','hour_rate', 'phone','email','brand','color','type','prior_work','accessories','work_requested','warranty','note','_token']; // Add the names you want to exclude
            if(!empty($exFields)) {
                $jsonData=[];
                foreach ($inputData as $key => $value) {
                    if (!in_array($key, $excludedInputNames)) {
                        $jsonData[$key]=$value;
                        
                    }
                }
                $exFields->keyNvalues=json_encode($jsonData);
                $exFields->save();
            } 

             // extra-fields-entry-end
            if($email) $repair->status_date = date('Y-m-d');
            if($repair->save()){
                session()->flash('success','Updated successfully!');
                if($email) app()->call(HomeController::class.'@sendMailInvoice', ['invoice' => $repair->token]);
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

    /* Delete */
    public function delete($id){   
        try{
            $repair = Repair::findOrFail($id);
            $exFields = extrafieldvalues::where('repairID', $id)->delete();

            if($repair->delete()) session()->flash('success','Deleted successfully!');
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
