@extends('layout.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-primary text-white">
                    <h5 class="card-title">Total Invoices</h5>
                    <p class="card-text">{{ $totalInvoices }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-success text-white">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">₹{{ $totalRevenue }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-danger text-white">
                    <h5 class="card-title">Total Outstanding Invoices</h5>
                    <p class="card-text">{{ $totalOutstandingInvoices }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="mb-0">Invoices</h1>
        <div class="d-flex">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="{{ route('invoices.index')}}">All</a></li>
                  <li><a class="dropdown-item" href="{{ route('invoices.index', ['is_paid' => 1])}}">Only Paid</a></li>
                  <li><a class="dropdown-item" href="{{ route('invoices.index', ['is_paid' => 0])}}">Only Unpaid</a></li>
                </ul>
              </div>
              <a href="{{ route('invoices.pdf') }}" class="btn btn-primary ms-2">Generate PDF</a>
              <form class="d-flex ms-2" action="{{ route('invoices.index') }}">
                <input class="form-control me-2" type="search" placeholder="Search" name="search" value="{{ $search ?? ''}}">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <a href="{{ route('invoices.create') }}" class="btn btn-primary ms-2">Create Invoice</a>

        </div>
    </div>

    <table class="table">
        <tr>
            <th>Customer Name</th>
            <th>Reference Id</th>
            <th>Invoice Date</th>
            <th>Due Date</th>
            <th>Total</th>
            <th>Is Paid</th>
            <th>Action</th>
        </tr>

        @forelse ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->customer_name }}</td>
                <td>{{ $invoice->reference_id }}</td>
                <td>{{ $invoice->invoice_date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>₹{{ $invoice->total_amount }}</td>
                <td>{{ $invoice->is_paid ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-success">Show</a>
                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('invoices.destroy', $invoice->id) }}" class="btn btn-primary">Delete</a>
                </td>
            </tr>
        @empty

            <tr class="text-center">
                <td colspan="7">No invoices found</td>
            </tr>

        @endforelse

    </table>
    {{ $invoices->links() }}
</div>
@endsection
