<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;"> <!-- Center the content -->
            <div class="col-md-4" style="margin-top:20px;"> <!-- Modified class for centering -->
                <h4>Login</h4>
                <hr>
                <form action="{{route('login-user')}} " method="POST">
                    @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif

                    @if (Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf

                    <div class="mb-3"> <!-- Add margin bottom between label and input -->
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email"
                            value="{{old('email')}}">
                        <span class="text-danger">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3"> <!-- Add margin bottom between label and input -->
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password"
                            value="{{old('password')}}">
                        <span class="text-danger">
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3"> <!-- Add margin bottom between input and button -->
                        <button class="btn btn-block btn-primary" type="submit">
                            Login
                        </button>
                    </div>
                    <br>
                    <p class="text-left">New User !! <a href="register">Register Here.</a></p>

                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
