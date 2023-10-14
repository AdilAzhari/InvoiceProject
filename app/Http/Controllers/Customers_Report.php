<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\sections;

class Customers_Report extends Controller
{
    public function index()
    {

        $sections = sections::all();

        return view('reports.customers_report', compact('sections'));
    }


    public function Search_customers(Request $request)
    {


        // في حالة البحث بدون التاريخ

        if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {


            $invoices = Invoice::select('*')->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = sections::all();
            return view('reports.customers_report', compact('sections'))->withDetails($invoices);
        }


        // في حالة البحث بتاريخ

        else {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = sections::all();
            return view('reports.customers_report', compact('sections'))->withDetails($invoices);
        }
    }
}
