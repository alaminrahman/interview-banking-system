@extends('frontend.master')

@section('title', 'Deposit')

@section('content')
  <section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">

                <div class="title my-5">
                    <h3>All withdraw transactions</h3>
                </div>

                <div class="row">
                  <div class="col-md-9">

                    <div class="transactions-area my-5">
                      <p class="fw-bold">Withdraws</p>
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
                          @forelse($withdraws as $key => $withdraw)
                          <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>৳{{ $withdraw->amount }}</td>
                            <td>৳{{ $withdraw->fee }}</td>
                            <td>{{ date('d M y h:i A', strtotime($withdraw->date)) }}</td>
                          </tr>
                          @empty 
                          <tr>
                            <td class="text-center" colspan="4">No withdraw found!</td>
                          </tr>
                          @endforelse 

                        </tbody>
                      </table>

                      <div class="paginate my-3">
                        {{ $withdraws->links() }}
                      </div>
                    </div><!--End Transaction Area-->

                  </div><!--End Col-->

                  <div class="col-md-3">
                    <div class="card">

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

                            <form action="{{ route('user.withdraw.request') }}" method="post" class="row g-3">
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
                                    <button type="submit" class="btn btn-primary">Withdraw</button>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
                </div><!--End Row-->

                

            </div><!--End Col-->
       
        </div><!--End Row-->
    </div><!--End Container-->
  </section>

@endsection