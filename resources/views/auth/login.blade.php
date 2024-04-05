@extends('layout.app')


@section('content')
   <div class="container-fluid">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow w-50">
            <div class="card-body">

                <h1 class="text-center mb-4">Login</h1>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
   </div>
@endsection
