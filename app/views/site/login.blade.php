@extends('layouts.default')

@section('content')
<!-- Heading Row -->
        <div class="row">
            
            <!-- /.col-md-8 -->
            <div class="module module-login col-md-4 offset4 well">

            <!-- <div class="module module-login span4 offset4"> -->

                <h3 id="pad">IcePay Login</h3>
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>{{ implode('', $errors->all('<p>:message</p>')) }}</strong>
                    </div>
                    @endif 
                {{Form::open(array('url'=>'login', 'class'=>'form-horizontal', 'role'=>'form'))}}
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="username" type="text" name="username" class="form-control" value="{{ Input::old('username') }}" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success pull-right">Login to My Account</button>
                        </div>
                    </div>
                    <a href="{{URL::route('home')}}">Create new acccount</a>
                    {{Form::token()}}


                {{Form::close()}}

            </div>
            <!-- /.col-md-4 -->
        </div>
@stop
