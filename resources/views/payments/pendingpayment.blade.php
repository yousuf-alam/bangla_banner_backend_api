<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Document</title>

    <style>
        /* Add styles here */
        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #dee2e6; /* Table border */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6; /* Row borders */
        }

        th {
            background-color: #f8f9fa; /* Table header background color */
            font-weight: bold;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-light {
            background-color: #f8f9fa; /* Table header background color */
        }

        /* Added Styles */
        .action-buttons {
            display: flex;
            flex-direction: row;
            gap: 5px;
        }
    </style>
</head>
<body>
<div class="card-body">
    <div class="listjs-table">
        <div class="table-responsive table-card mb-1">
            <table class="table align-middle table-nowrap">
                <thead class="table-light">
                <tr>
                    <th class="text-center">User</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Payment Method</th>
                    <th class="text-center">Transaction ID</th>
                    <th class="text-center">Payment Number</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>

                </tr>
                </thead>
                <tbody class="list form-check-all">
                @foreach ($pendingPayments as $payment)
                    <tr>
                        <td class="text-center">{{ $payment->user->name }}</td>
                        <td class="text-center">{{ $payment->user->phone }}</td>
                        <td class="text-center">{{ $payment->payment_method }}</td>
                        <td class="text-center">{{ $payment->trans_id }}</td>
                        <td class="text-center">{{ $payment->payment_number }}</td>
                        <td class="text-center">{{ $payment->amount }}</td>
                        <td class="text-center">{{ $payment->status }}</td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('edit.payment', $payment->id) }}">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                </a>

                                    <form action="#" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="#" method="post"
                                          onsubmit="return confirm('Are you sure you want to reject this payment?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Reject
                                        </button>
                                    </form>

                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
