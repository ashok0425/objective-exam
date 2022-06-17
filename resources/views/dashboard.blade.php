@extends('layout.master')

@section('content')
    {{-- {{dd()}} --}}
    <div class="container">
        <div class="alert alert-success">
            Login Successfull
        </div>
        
                <div class="row">
                    @php
                        $user = session()->get('user');
                    @endphp
                    <div class="col-md-6">
                     <div class="card">
                        <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary pt-2 ">Profile Detail</h6>

                        </div>
                        <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>
                                    Full name
                                </th>
                                <th>
                                    {{ $user->first_name . $user->last_name }}
                                </th>
                            </tr>

                            <tr>
                              <th>
                                  Email
                              </th>
                              <th>
                                  {{ $user->email }}
                              </th>
                          </tr>




                          <tr>
                           <th>
                               Phone
                           </th>
                           <th>
                               {{ $user->mobile }}
                           </th>
                       </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
