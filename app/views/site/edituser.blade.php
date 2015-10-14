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
                <div class="col-md-6">
                        <!--<a href="{{URL::to('payment')}}" class="btn btn-primary"><h4> PayPal => Mobile money Transfer</h4></a>-->
                        <div class="card" style="width:100%">
                        <div class="image">
                            <img src="{{URL::to('images')}}/mm2.jpg"/><br />
                            <span class="title" id="card"></span>
                        </div>
                        <div class="content">
                          <span class="title" id="card">PayPal => Mobile Money Transfer</span>
                          <p>Send money to a mobile money account from your paypal account. You pay to us, we deliver for You.</p>
                        </div>
                        <div class="action">
                          <a href="#" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#pp2mm">
                            <span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Send Money</a>
                        </div>
                    
                    </div>
                </div>

                <div class="col-md-6">
                        <!-- <a href="#" class="btn btn-primary"><h4>Mobile Money => PayPal Transfer</h4></a> -->
                        <div class="card" style="width:100%">
                        <div class="image">
                            <img src="{{URL::to('images')}}/pp2.gif"/><br />
                            <span class="title" id="card"></span>
                        </div>
                        <div class="content">
                          <span class="title" id="card">Mobile Money => PayPal Transfer</span>
                          <p>Send money to a paypal account from your mobile money account. You pay to us, we deliver for You.</p>
                        </div>
                        <div class="action">
                          <a href="#" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#mm2pp">
                          <span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;Send Money</a>
                        </div>
                    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card" style="width:100%">
                        <div class="image">
                            <img src="{{URL::to('images')}}/invoice.jpg"/><br />
                            <span class="title" id="card" ></span>
                        </div>
                        <div class="content">
                          <span class="title" id="card" >Manage Invoice</span>
                          <p>Manage invoices and track pending transactions</p>
                        </div>
                        <div class="action">
                          <a href="#" class="btn btn-info btn-lg btn-block">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;&nbsp;Manage Invoice</a>
                        </div>
                    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card" style="width:100%">
                        <div class="image">
                            <img src="{{URL::to('images')}}/history.jpg"/><br />
                            <span class="title" id="card" ></span>
                        </div>
                        <div class="content">
                          <span class="title" id="card" >Transaction history</span>
                          <p>View and manage your transaction history. </p>
                        </div>
                        <div class="action">
                          <a href="{{URL::route('dashboard.transaction')}}" class="btn btn-info btn-lg btn-block">
                            <span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Transaction history</a>
                        </div>
                    
                    </div>
                </div>

            </div>
            <!-- /.col-md-8 -->
            <div class="col-md-4 well">
                <!--<div class="well">
                    <div class="media">
                            <div class="media-body">
                              <h3 class="media-heading">{{$user->username}}</h3>
                               <br />
                              <table class="table table-condensed table-hover" >
                              <tr>
                                <td>Email</td>
                                <td>{{$user->email}}</td>
                              </tr>
                              <tr>
                                <td>Phone</td>
                                <td>{{$user->number}}</td>
                              </tr>
                              <tr>
                                <td>Country</td>
                                <td>{{$user->country}}</td>
                              </tr>
                              </table>
                            </div>
                        </div>
                    <br />
                </div> 
                -->
                <h3 id="pad">Edit Account</h3>
                {{Form::open(array('url'=>'dashboard/account/manage', 'class'=>'form-horizontal', 'role'=>'form'))}}
                    <input type="hidden" name="special"  value="{{Auth::user()->id}}" />
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="username" type="text" name="username" class="form-control" placeholder="Username" value="{{ $user->username }}">
                            <span class="badge alert-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="email" type="text" name="email" class="form-control" placeholder="Email as used in PayPal" value="{{$user->email}}">
                            <span class="badge alert-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="pnumber" type="number" name="number" class="form-control" placeholder="Mobile money phone number" value="{{ $user->number }}">
                            <span class="badge alert-danger">{{ $errors->first('number') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="country" class="col-sm-12">
                          <!-- <label for="name">Country</label> -->
                            <select class="form-control" name="country">
                            <option selected="selected" >Select Country</option>
                            <option value="Cameroon" >Cameroon</option>
                            <option value="Nigeria" >Nigeria</option>
                            <option value="Chad" >Chad</option>
                            <option value="Congo" >Congo</option>
                            </select>
                            <span class="badge alert-danger">{{ $errors->first('country') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="checkbox">
                            <label>
                                <input id="nletter" type="checkbox" name="nletter" > Receive offers and newsletters
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Update My Account</button>
                        </div>
                    </div>
                {{Form::close()}}
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

        <!-- modal for mobile money to paypal transction -->
        <div class="modal fade" id="mm2pp">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mobile Money To Paypal Transfer</h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('url'=>'transfer', 'class'=>'form-horizontal', 'role'=>'form'))}}
                  <div class="row">
                      <div class="col-xs-6">
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                              <input type="email" id="email" name="email" class="form-control" placeholder="recipient paypal email" required>
                          </div>
                      </div>
                      <div class="col-xs-6">
                          <div class="input-group">
                              <input type="number" id="amount" name="amount" min="5000" class="form-control" placeholder="Amount " required>
                              <span class="input-group-addon">FCFA</span>
                          </div>
                      </div>
                      
                  </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Continue</button>
              </div>
              {{Form::token()}}
              {{Form::close()}}
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- modal for paypal to mobile money -->
        <div class="modal fade" id="pp2mm">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Paypal To Mobile Money Transfer</h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('url'=>'payment', 'class'=>'form-horizontal', 'role'=>'form'))}}
                  <div class="row">
                      <div class="col-xs-4">
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                              <input type="number" id="number" name="number" min="600000000" class="form-control" placeholder="mobile money number" required>
                          </div>
                      </div>
                      <div class="col-xs-4">
                          <div class="input-group">
                              <input type="number" id="amount" name="amount" min="10" class="form-control" placeholder="Amount" required>
                              <span class="input-group-addon">.00</span>
                          </div>
                      </div>
                      <div class="form-group">
                        <div id="currency" class="col-xs-4">
                          <!-- <label for="name">Country</label> -->
                            <select class="form-control" name="currency">
                            <option selected="selected" value="USD">USD - US Dollars</option>
                            <option value="EUR">EUR - Euros</option>
                            <option value="GBP">GBP - Bristish Pounds</option>
                            </select>
                        </div>
                    </div>
                      
                  </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Continue</button>
              </div>
              {{Form::token()}}
              {{Form::close()}}
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@stop
