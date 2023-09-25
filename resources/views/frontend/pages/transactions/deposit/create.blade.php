@extends('frontend.master')

@section('title', 'Deposit')

@section('content')


<section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 ">

                <div class="card shadow mt-5">
                    <div class="card-header">
                        <span>Deposit Request</span>
                    </div>
                    
                        <div class="card-body">

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

                        @include('components.flash-message')

                        <form action="{{ route('user.deposit') }}" method="post" class="row g-3">
                            @csrf 

                            <div class="col-md-12">
                                <label for="user_id" class="form-label">User Account</label>
                                <select name="user_id" class="form-select">
                                    <option selected>Choose...</option>
                                    @forelse(\App\Models\User::orderBy('name', 'asc')->get() as $key => $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @empty 
                                        <option value="">User not found!</option>
                                    @endforelse 
                                </select>
                            </div>
                            
                            <div class="col-12">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" placeholder="0.00">
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>


            </div><!--End Col-->
        </div><!--End Row-->
    </div><!--End Container-->
</section>
@endsection