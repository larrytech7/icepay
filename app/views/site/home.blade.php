@extends('layouts.default')

@section('content')
<!-- Heading Row -->
        <div class="row">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h1>Welcome to IcePay</h1>
                    <p>
                        Icepay is your number one hybrid international money transfer platform. Send money 
                        to and fro your preferred transfer platforms. Get paid by through these platforms.
                    </p>
                    <br/><br/><br/>
                    <p>
                        <img src="{{URL::to('images')}}/icepay.JPG" alt="" class="img-responsive img-rounded">
                    </p>
                    <p>
                        Disrupting online payments accross the African Continent.
                    </p>
                    
                </div>
            <!--<div class="well"><h3>CAPTION , SLOGAN, INFORMATION, CAROUSEL</h3></div> -->
            <!--<img class="img-responsive img-rounded" src="http://placehold.it/900x630" alt="">-->
            <!--
                <h1 style="color: #111; font-family: Droid Serif;font-weight: 100;font-style: normal;">
                    Welcome to IcePay
                </h1>
                <h3> Icepay is your number one hybrid international money transfer platform. Send money 
                    to and fro your preferred transfer platforms. Get paid by through these platforms.
                </h3>
                <img src="{{URL::to('images')}}/icepay.JPG" alt="" class="img-responsive img-rounded"> <br />
                <div class="col-md-4" style="width: 50%">
                    <img src="{{URL::to('images')}}/mm.jpg" alt="" class="img-responsive img-rounded">
                </div>
                <div class="col-md-4" style="width: 50%">
                    <img src="{{URL::to('images')}}/pp1.jpg" alt="" class="img-responsive img-rounded">
                </div> 
                -->
            </div>
            <!-- /.col-md-8 -->
            <div class="col-md-4 well">
                <h3 id="pad">Create Account</h3>
                {{Form::open(array('url'=>'register', 'class'=>'form-horizontal', 'role'=>'form'))}}

                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="username" type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('username') }}">
                            <span class="badge alert-danger">{{ $errors->first('username') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="email" type="text" name="email" class="form-control" placeholder="Email as used in PayPal" value="{{ Input::old('email') }}">
                            <span class="badge alert-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="number" type="text" name="number" class="form-control" placeholder="Mobile money phone number" value="{{ Input::old('number') }}">
                            <span class="badge alert-danger">{{ $errors->first('number') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="password" type="password" name="password" class="form-control" placeholder="Password">
                            <span class="badge alert-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                            <span class="badge alert-danger">{{ $errors->first('confirm_password') }}</span>
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
                                <input id="nletter" type="checkbox" name="newsletter"> Receive offers and newsletters
                            </label>
                            </div>
                            <div class="checkbox">
                            <label>
                                <input id="terms" type="checkbox" name="terms"> Agree to terms and Conditions
                                <span class="badge alert-danger">{{ $errors->first('terms') }}</span>
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Create My Account</button>
                        </div>
                    </div>
                    {{Form::token()}}
                    
                {{Form::close()}}

            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
@stop
