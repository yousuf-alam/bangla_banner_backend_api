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
        <div class="row">
            <div class="col-md-4 col-md-offset-4 style="margin-top:20px;">

                <h4>Registration</h4>
                <hr>
                <form action="{{route('register-user')}}" method="POST">
                    @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif

                    @if (Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get(fail)}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" placeholder="Enter Full Name" name="name"
                            value="{{old('name')}}">
                            <span class="text-danger">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email"
                            value="{{old('email')}}">
                            <span class="text-danger">
                                @error('email')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter Phone" name="phone"
                            value="{{old('phone')}}">
                            <span class="text-danger">
                                @error('phone')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password"
                            value="{{old('password')}}">
                            <span class="text-danger">
                                @error('password')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">
                            Register
                        </button>
                    </div>
                    <br>

                    <span>Already Registered !!</span><br>
                    <a href="/login"> Login Here.</a>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
