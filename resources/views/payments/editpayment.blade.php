<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Payment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
        body {
            background-color: #f8f9fa; /* Set background color */
        }
        .container {
            min-height: 100vh; /* Set minimum height of container */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: #fff; /* Set background color for form container */
            padding: 20px; /* Add padding */
            border-radius: 10px; /* Add border radius */
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Add box shadow */
        }
        .form-group {
            margin-bottom: 20px; /* Add bottom margin */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-6 form-container">
            <h4 class="text-center mb-4">Edit Payment</h4>
            <form action="{{ route('update.payment', $payment->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select id="payment_method" name="payment_method" class="form-control">
                        <option value="bkash" {{ $payment->payment_method == 'bkash' ? 'selected' : '' }}>Bkash</option>
                        <option value="ssl" {{ $payment->payment_method == 'ssl' ? 'selected' : '' }}>SSL</option>
                        <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trans_id">Transaction ID:</label>
                    <input type="text" id="trans_id" name="trans_id" value="{{ $payment->trans_id }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="payment_number">Payment Number:</label>
                    <input type="text" id="payment_number" name="payment_number" value="{{ $payment->payment_number }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="text" id="amount" name="amount" value="{{ $payment->amount }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control">
                        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update Payment</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
