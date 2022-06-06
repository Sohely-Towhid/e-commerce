@extends('frontend.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card my-5">
                    <div class="card-header">
                        <h3>Send Reset link</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.reset.store') }}" method="POST">
                            @csrf
                            <div class="mt-3">
                                <input type="email" name="email" class="from-control" placeholder="Email">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Send Link</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
