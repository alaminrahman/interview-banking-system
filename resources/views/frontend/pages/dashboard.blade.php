@extends('frontend.master')

@section('title', 'Dashboard')

@section('content')
  <section>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">

                <div class="title text-center">
                    <h1>Hi, {{ auth()->user()->name }} Welcome to Dashboard</h1>
                </div>

            </div><!--End Col-->
       
        </div><!--End Row-->
    </div><!--End Container-->
  </section>

@endsection