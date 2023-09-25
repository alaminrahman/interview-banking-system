@extends('frontend.master')

@section('title', 'Open Account')

@section('content')
  <section>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">

            <div class="card shadow">
                <div class="card-header">
                    <span>Open Account</span>
                </div>
                <div class="card-body">

                    @include('components.flash-message')

                    <div class="validation-message my-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('user.store') }}" method="post" class="row g-3">
                        @csrf 
                        
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>

                        <div class="col-md-12">
                            <label for="account_type" class="form-label">Account Type</label>
                            <select name="account_type" class="form-select">
                                <option selected>Choose...</option>
                                <option value="individual">Individual</option>
                                <option value="business">Business</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <div class="col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create Account</button>
                        </div>
                    </form>

                </div>
            </div>

                
            
            </div><!--End Col-->
       
        </div><!--End Row-->
    </div><!--End Container-->
  </section>

@endsection