@extends('frontend.master')

@section('title', 'Deposit')

@section('content')
  <section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">

                <div class="title my-5">
                    <h3>All deposit transactions</h3>
                </div>

                <div class="row">
                  <div class="col-md-9">

                    <div class="transactions-area my-5">
                      <p class="fw-bold">Deposit</p>
                      <hr/>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($deposits as $key => $deposit)
                          <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>৳{{ $deposit->amount }}</td>
                            <td>৳{{ $deposit->fee }}</td>
                            <td>{{ date('d M y h:i A', strtotime($deposit->date)) }}</td>
                          </tr>
                          @empty 
                          <tr>
                            <td class="text-center" colspan="4">No deposit found!</td>
                          </tr>
                          @endforelse 

                        </tbody>
                      </table>

                      <div class="paginate my-3">
                        {{ $deposits->links() }}
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