<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request){

        $search = $request->input('search');
        if ($request->input('is_paid')) {
            $invoices = Invoice::where('is_paid', $request->input('is_paid'))->paginate(2);
        } elseif ($search){
            $invoices = Invoice::where('reference_id', 'like', '%'.$search.'%')->paginate(2);
        } else {
            $invoices = Invoice::paginate(2);
        }

        $totalInvoices = Invoice::count();
        $totalRevenue = Invoice::where('is_paid', '1')->sum('total_amount');
        $totalOutstandingInvoices = Invoice::where('is_paid', '0')->where('due_date', '<', date('Y-m-d'))->count();

        return view('invoices.index', compact('invoices', 'totalInvoices', 'totalRevenue', 'totalOutstandingInvoices','search'));
    }

    public function create(){

        return view('invoices.create');
    }

    public function store(CreateInvoiceRequest $request){

        $input = $request->all();

        foreach ($input['name'] as $key => $value) {
            $data[] = [
                'name' => $value,
                'price' => $input['price'][$key],
                'tax' => $input['tax'][$key] ?? 0,
                'quantities' => $input['quantities'][$key],
                'total' => $input['price'][$key] * $input['quantities'][$key] + $input['tax'][$key]
            ];
        }

        $totalAmount = collect($data)->sum('total');

        $input['reference_id'] = $this->getReferenceId();

        $invoice = Invoice::create([
            'customer_name' => $input['customer_name'],
            'invoice_date' => $input['invoice_date'],
            'due_date' => $input['due_date'],
            'total_amount' => $totalAmount,
            'is_paid' => $input['is_paid'] ?? 0,
            'reference_id' => $input['reference_id']
        ]);

        foreach ($data as $key => $value) {
            $invoice->invoiceItems()->create($value);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');
    }

    public function edit($id){

        $invoice = Invoice::with('invoiceItems')->findOrFail($id);

        $invoiceItems = $invoice->invoiceItems()->get();

        $invoiceItemsHTML = view('invoices.add-invoice-items', compact('invoiceItems'))->render();

        return view('invoices.edit', compact('invoice', 'invoiceItemsHTML'));
    }

    public function update(UpdateInvoiceRequest $request, $id){

        $input = $request->all();

        foreach ($input['name'] as $key => $value) {
            $data[] = [
                'name' => $value,
                'id' => $input['id'][$key] ?? null,
                'price' => $input['price'][$key],
                'tax' => $input['tax'][$key] ?? 0,
                'quantities' => $input['quantities'][$key],
                'total' => $input['price'][$key] * $input['quantities'][$key] + $input['tax'][$key]
            ];
        }

        $totalAmount = collect($data)->sum('total');

        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'customer_name' => $input['customer_name'],
            'invoice_date' => $input['invoice_date'],
            'due_date' => $input['due_date'],
            'total_amount' => $totalAmount,
            'is_paid' => $input['is_paid'] ?? 0,
        ]);


        foreach ($data as $key => $value) {
            if ($value['id'] == null) {
                $invoice->invoiceItems()->create($value);
            } else {
                $invoice->invoiceItems()->find($value['id'])->update($value);
            }
        }

        $invoice->invoiceItems()->whereNotIn('id', collect($data)->pluck('id'))->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully');


    }

    public function destroy($id){

        InvoiceItem::where('invoice_id', $id)->delete();
        Invoice::where('id', $id)->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully');


    }

    public function addInvoiceItems(){

        return view('invoices.add-invoice-items');
    }


    public function generatePDF(){

       $invoices = Invoice::with('invoiceItems')->get();

       $pdf = Pdf::loadView('invoices.pdf', compact('invoices'));
    return $pdf->download('invoices.pdf');
    }

    public function show($id){

        $invoice = Invoice::with('invoiceItems')->find($id);

        return view('invoices.show', compact('invoice'));
    }

    public function getReferenceId(){

        $ref = 'INV-' . rand(100000, 999999);

        if (Invoice::where('reference_id', $ref)->exists()) {

            $this->getReferenceId();
        }

        return $ref;


    }
}

