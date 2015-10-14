@extends('layouts.default')

@section('content')
<!-- Heading Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-6">
                    <img src="{{URL::to('images')}}/mm.jpg" alt="" class="img-responsive img-rounded">
                </div>
                <div class="col-md-6">
                    <img src="{{URL::to('images')}}/pp.jpg" alt="" class="img-responsive img-rounded">
                </div> 
                <!-- <img src="{{URL::to('images')}}/paypal.jpg"> -->
            </div>
            <!-- /.col-md-12 -->
        </div> <br />

        <!-- Heading Row -->
        <div class="row">
            <div class="col-md-8">
                    <div class="media-body">
                              <h3 class="media-heading">Transaction History  <a href="{{URL::route('dashboard')}}" title="Dashboard"><i class="glyphicon glyphicon-home"></i></a></h3>
                               <br />
                              <table class="table table-condensed table-hover" >
                              <tr class="table-bordered">
                                <th>Date</th>
                                <th>Type</th>
                                <th>Sender</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Receiver</th>
                              </tr>
                              <!--@if($transactions != null)
                                @foreach($transactions as $transaction)
                                <tr>
                                  <td>{{ $transaction->created_at }}</td>
                                  <td>{{ $transaction->type }}</td>
                                  <td>{{ $transaction->sender_email }}</td>
                                  <td>{{ $transaction->status }}</td>
                                  <td>{{ $transaction->amount }}</td>
                                  <td>{{ $transaction->receiver_email }}</td>
                                </tr>
                                @endforeach
                              @endif -->

                              @foreach($transactions as $transaction)
                              <tr>
                                  <td>{{ date("F jS, Y -- g:i A",strtotime($transaction->created_at)) }}</td>
                                  <td>{{ $transaction->type }}</td>
                                  <td>{{ $transaction->sender_email }}</td>
                                  <td>{{ $transaction->status }}</td>
                                  <td>{{ $transaction->amount }}</td>
                                  <td>{{ $transaction->receiver_email }}</td>
                                </tr>
                                @endforeach

                              </table>


                            </div>

            </div>
            <!-- /.col-md-8 -->
            <div class="col-md-4">
                <div class="flip-card active-card full-card" >
                        <div class="pcard label-info">
                            <a href=""><img class=" img-circle text-center" src="{{URL::to('images')}}/user.jpg"/></a>
                        </div>
                        
                        <a href="{{URL::route('viewprofile')}}" class="btn btn-primary btn-fab btn-raised " id="first" title="View User Account">
                            <span class="glyphicon glyphicon-user"></span>
                        </a>
                        <a href="" class="btn btn-primary btn-fab btn-raised ">
                            <span class="glyphicon glyphicon-stats"></span>&nbsp; 
                        </a>
                        <div class="well">
                            <h3>{{$user->username}}</h3>                            
                        </div>                        
                 </div>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

@stop
