<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\invoice_attachments;
use App\Models\invoices_details as ModelsInvoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class invoices_details extends Controller
{

    public function edit($id)

    {
        $invoices = Invoice::where('id', $id)->first();
        $details  = ModelsInvoices_details::where('id_Invoice', $id)->get();
        $attachments  = invoice_attachments::where('invoice_id', $id)->get();

        return view('invoices.invoices_Partial', compact('invoices', 'details', 'attachments'));
    }

    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function get_file($invoice_number, $file_name)

    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }



    public function open_file($invoice_number, $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($files);
    }
}
