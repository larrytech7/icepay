@extends('layouts.default')

@section('content')
<!-- Heading Row -->
        <div class="row">
            <div class="col-md-4 well offset4">
                <h3 id="pad">Create Account</h3>
                {{Form::open(array('url'=>'register', 'class'=>'form-horizontal', 'role'=>'form'))}}
                    {{Form::token()}}
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="username" type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('name') }}">
                            <span class="badge alert-danger">{{ $errors->first('name') }}</span>
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
                            <input id="pnumber" type="number" name="number" class="form-control" placeholder="Mobile money phone number" value="{{ Input::old('number') }}">
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
                            <input id="confrim_password" type="password" name="confrim_password" class="form-control" placeholder="Confirm Password">
                            <span class="badge alert-danger">{{ $errors->first('cpassword') }}</span>
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
                            <div class="checkbox">
                            <label>
                                <input id="terms" type="checkbox" name="terms" > Agree to terms and Conditions
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
                {{Form::close()}}

            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
@stop
