@extends('frontend.master')

@section('title', 'Dashboard')

@section('content')
  <section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">

                <div class="title my-5">
                    <h3>Hi, <span class="text-success">Mr./Mrs. {{ auth()->user()->name }}</span> Welcome to Dashboard</h3>
                </div>

                <div class="row">
                  <div class="col-md-9">

                    <div class="transactions-area">
                      <p class="fw-bold">Transactions</p>
                      <hr/>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">To Account</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Transaction Type</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($transactions as $key => $transaction)
                          <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $transaction->user_id }}</td>
                            <td>৳{{ $transaction->amount }}</td>
                            <td>৳{{ $transaction->fee }}</td>
                            <td>{{ $transaction->transaction_type }}</td>
                            <td>{{ date('d M y h:i A', strtotime($transaction->date)) }}</td>
                          </tr>
                          @empty 
                          <tr>
                            <td class="text-center" colspan="6">No transactions found!</td>
                          </tr>
                          @endforelse 

                        </tbody>
                      </table>

                      <div class="paginate my-3">
                        {{ $transactions->links() }}
                      </div>
                    </div><!--End Transaction Area-->

                  </div><!--End Col-->

                  <div class="col-md-3">
                    @include('frontend.partials._accountType')
                  </div>
                </div><!--End Row-->

                

            </div><!--End Col-->
       
        </div><!--End Row-->
    </div><!--End Container-->
  </section>

@endsection