@extends('layouts.default')

@section('content')
    <!-- Heading Row -->
        <div class="row">
            
            <!-- /.col-md-8 -->
            <div class="module module-login col-md-4 offset4 well">

            <!-- <div class="module module-login span4 offset4"> -->

                <h3 id="pad">Modify Password</h3>
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>{{ implode('', $errors->all('<p>:message</p>')) }}</strong>
                    </div>
                    @endif 
                {{Form::open(array('url'=>'change-password-post', 'class'=>'form-horizontal', 'role'=>'form'))}}
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" name="old_password" class="form-control" placeholder="Current Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" name="password" class="form-control" placeholder=" New Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success pull-right">Change Password</button>
                            <a href="{{URL::route('dashboard')}}" class="btn btn-danger pull-left">Back</a>
                        </div>
                    </div>
                    {{Form::token()}}


                {{Form::close()}}

            </div>
            <!-- /.col-md-4 -->
        </div>
@stop
