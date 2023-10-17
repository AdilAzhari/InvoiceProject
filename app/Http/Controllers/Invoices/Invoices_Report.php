<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\invoices;
use App\Models\Invoice;

class Invoices_Report extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }

    /**
     * The function `Search_invoices` selects invoices based on different search criteria and
     * returns them to a view for display.
     *
     * @param Request request The request parameter is an instance of the `Request` class, which
     * represents an HTTP request. It contains all the data and information about the current request,
     * such as the request method, URL, headers, and request parameters.
     *
     * @return a view called 'reports.invoices_report' with the selected invoices as the 'details'
     * variable.
     */
    public function Search_invoices(Request $request)
    {

        $rdio = $request->rdio;

        if ($rdio == 1) {

            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = invoice::select('*')->where('Status', '=', $request->type)->get();
                $type = $request->type;
                return view('reports.invoices_report', compact('type'))->withDetails($invoices);
            } else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', '=', $request->type)->get();
                return view('reports.invoices_report', compact('type', 'start_at', 'end_at'))->withDetails($invoices);
            }
        }

        //====================================================================

       /* The code block inside the `else` statement is executed when the value of `` is not equal
       to 1. It selects all columns from the `invoices` table where the `invoice_number` column is
       equal to the value of `->invoice_number`. It then returns the view
       'reports.invoices_report' and passes the selected invoices as the 'details' variable to the
       view. */
        else {

            $invoices = invoice::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);
        }
    }
}
