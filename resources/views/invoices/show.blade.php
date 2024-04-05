@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
               <div class="d-flex justify-content-between mb-5 align-items-center">
                <h1 class="">Invoice Details</h1>
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary ms-2">Back</a>
               </div>
               <div class="mb-5">
                <table class="table w-50">
                    <tr>
                        <th>Customer Name</th>
                        <td>: {{ $invoice->customer_name }}</td>
                    </tr>

                    <tr>
                        <th>Invoice Date</th>
                        <td>: {{ $invoice->invoice_date }}</td>
                    </tr>

                    <tr>
                        <th>Due Date</th>
                        <td>: {{ $invoice->due_date }}</td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td>: ₹{{ $invoice->total_amount }}</td>
                    </tr>

                    <tr>
                        <th>Is Paid</th>
                        <td>: {{ $invoice->is_paid ? 'Yes' : 'No' }}</td>
                    </tr>
                </table>
               </div>


               <hr>

                <h3>Invoice Items</h1>

                <table class="table">
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Tax</th>
                    </tr>

                    @foreach($invoice->invoiceItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantities }}</td>
                            <td>₹{{ $item->price }}</td>
                            <td>{{ $item->tax }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>
    </div>
@endsection

