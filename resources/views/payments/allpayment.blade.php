 

@section('content')
<div class="card-body">
    <div class="listjs-table">
        <div class="table-responsive table-card mb-1">
            <table class="table align-middle table-nowrap">
                <thead class="table-light">
                    <tr>
                        <th data-sort="customer_name">User</th>
                        <th data-sort="phone">Phone</th>
                        <th data-sort="payment_method">Payment Method</th>
                        <th data-sort="trans_id">Transaction ID</th>
                        <th data-sort="payment_number">Payment Number</th>
                        <th data-sort="amount">Amount</th>
                        <th data-sort="status">Status</th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    @foreach ($allPayments as $payment)
                        <tr>
                            <td class="customer_name">{{ $payment->user->name }}</td>
                            <td class="phone">{{ $payment->user->phone }}</td>
                            <td class="payment_method">{{ $payment->payment_method }}</td>
                            <td class="trans_id">{{ $payment->trans_id }}</td>
                            <td class="payment_number">{{ $payment->payment_number }}</td>
                            <td class="amount">{{ $payment->amount }}</td>
                            <td class="status">{{ $payment->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
    <style>
        .table-light th {
            text-align: center;
        }
    </style>
@endsection
