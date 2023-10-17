<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceAchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoice::onlyTrashed()->get();
        return view('Invoices.Archive_Invoices',compact('invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request)
    {
         $id = $request->invoice_id;
         $flight = Invoice::withTrashed()->where('id', $id)->restore();
         session()->flash('restore_invoice');
         return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $invoices = Invoice::withTrashed()->where('id',$request->invoice_id)->first();
         $invoices->forceDelete();
         session()->flash('delete_invoice');
         return redirect('/Archive');

    }
}
