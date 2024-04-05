@extends('layout.app')

@section('content')

<div class="container-fluid mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Create Invoice</h1>
        <a href="{{ route('invoices.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('invoices.store') }}" method="POST" id="addInvoiceForm">
                @csrf

                <div class="form-group mb-3">
                    <label for="title">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="title">Invoice Date</label>
                    <input type="date" name="invoice_date" id="invoice_date" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="title">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="is_paid"> Is Paid</label>
                    <input type="checkbox" name="is_paid" id="is_paid" value="1">
                </div>

                <div class="form-group mb-3">
                    <a role="button" class="btn btn-success" id="addInvoiceItems">Add Items</a>
                </div>


                <hr>
                <div id="invoiceItems" class="my-2"></div>


                <a role="button" id="submitAddInvoiceForm" class="btn btn-primary">Submit</a>

            </form>
        </div>
    </div>

</div>

@endsection
