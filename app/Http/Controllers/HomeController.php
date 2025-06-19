<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Validation\Rule;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    public function index(Request $request){
        try{
            if($request->has('invoice')){
                $token = $request->invoice;
                $repair = Repair::where('token',$token)->with('materials','company')->first();
                return view('home',compact('repair'));
            }
            else return view('home');
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }

    /* PDF */
    public function pdf($invoice){
        if($invoice){
            $repair = Repair::where('token',$invoice)->with('materials','company')->first();
            $pdf = PDF::loadView('invoice', compact('repair'));
            return $pdf->download($repair->token.'.pdf');
        }
    }

    /* Resend Email */
    public function resendEmail($id){
        try{
            /* Generate PDF */
            $repair = Repair::where('id', $id)->with('materials', 'company')->first();
            $pdf = PDF::loadView('invoice', compact('repair'));

            /* Send email */
            $customerEmail = $repair->email;
            $customerName = $repair->name;

            \Mail::send('email.invoice', ['customerName' => $customerName,'repair' => $repair], function ($message) use ($customerEmail, $customerName,$repair, $pdf) {
                $message->to($customerEmail, $customerName)
                        ->subject('Your Repair Order Reminder '.$repair->token)
                        ->attachData($pdf->output(), $repair->token.'.pdf');
            });
            return json_encode(['success'=>true,'message'=>'Mail sent succesfully!']);
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            return json_encode(['success'=>false,'message'=>'An error occurred. Please try again.']);
        }
    }

    /* Send Email with Attachment */
    public function sendMailInvoice($invoice){
        try{
            if($invoice){

                /* Generate PDF */
                $repair = Repair::where('token', $invoice)->with('materials', 'company')->first();
                $pdf = PDF::loadView('invoice', compact('repair'));

                /* Send email */
                $customerEmail = $repair->email;
                $customerName = $repair->name;

                \Mail::send('email.invoice', ['customerName' => $customerName,'repair' => $repair], function ($message) use ($customerEmail, $customerName,$repair, $pdf) {
                    $message->to($customerEmail, $customerName)
                            ->subject('Your Repair Order '.$repair->token)
                            ->attachData($pdf->output(), $repair->token.'.pdf');
                });
                session()->flash('success','Mail sent successfully!');
                return back();
            }
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error','An error occurred. Please try again.');
            return back();
        }
    }
}
