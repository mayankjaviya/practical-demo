<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice PDF</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;

        }
    </style>
</head>
<body>


    <h1>Invoices</h1>

    <table>
        <tr>
            <th>Customer Name</th>
            <th>Reference Id</th>
            <th>Invoice Date</th>
            <th>Due Date</th>
            <th>Total</th>
            <th>Is Paid</th>
        </tr>

        @forelse ($invoices as $invoice)

            <tr>
                <td>{{ $invoice->customer_name }}</td>
                <td>{{ $invoice->reference_id }}</td>
                <td>{{ $invoice->invoice_date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ $invoice->total_amount }}</td>
                <td>{{ $invoice->is_paid ? 'Yes' : 'No' }}</td>
            </tr>

        @empty

            <tr class="text-center">
                <td colspan="6">No invoices found</td>
            </tr>

        @endforelse
    </table>

</body>
</html>
