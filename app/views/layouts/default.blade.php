<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{URL::to('images')}}/favicon.ico">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{URL::to('css')}}/bootstrap.min.css">
    <link type="text/css" href="{{URL::to('css')}}/bootstrap-responsive.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="{{URL::to('css')}}/material.min.css">-->
    <link rel="stylesheet" href="{{URL::to('css')}}/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{URL::to('css')}}/font-awesome.css">
    

    <!-- Custom CSS -->
    <link href="{{URL::to('css')}}/small-business.css" rel="stylesheet">
    <link href="{{URL::to('css')}}/mystyle.css" rel="stylesheet">
    <link href="{{URL::to('css')}}/buttons.css" rel="stylesheet">
    <link href="{{URL::to('css')}}/flipper.css" rel="stylesheet">
    <link href="{{URL::to('css')}}/material-wfont.min.css" rel="stylesheet">




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container navbar-inner">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if(Auth::check()==NULL)
                <a class="brand" href="{{URL::route('home')}}">
                    <img src="{{URL::to('images')}}/logo.png" alt="IcePay Logo">
                </a>
                @endif
                @if(Auth::check())
                <a class="brand" href="{{URL::route('dashboard')}}" title="Dashboard">
                    <img src="{{URL::to('images')}}/logo.png" alt="IcePay Logo">
                </a>
                @endif
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <div class="navbar-form navbar-right">
                @if(Auth::check()==NULL)
                {{Form::open(array('route'=>'login', 'class'=>'form-horizontal', 'role'=>'form'))}}
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">                                        
                        </div>

                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</button>
                        {{Form::token()}}
                    
                {{Form::close()}}
                   <!--<small id="error" >Enter Username and Password</small> -->
                   @endif
                   @if(Auth::check())
                   <a href="{{URL::route('dashboard.change-password')}}" class="btn btn-success"> <span class="glyphicon glyphicon-lock"></span>&nbsp;Change Password</a>&nbsp;&nbsp;&nbsp;
                   <a href="{{URL::route('logout')}}" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span>&nbsp;
                    Logout </a><!--{{ Auth::user()->username }}-->
                   @endif
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        @if(Session::has('alertMessage'))
            <div class="row">
                <div class="col-lg-12 alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{{Session::get('alertMessage')}}</strong>
                </div>
                <!-- /.col-md-12 -->
            </div>
        @endif

        @if(Session::has('alertError'))
            <div class="col-lg-12 alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{Session::get('alertError')}}</strong>
            </div>
        @endif

        @yield('content')
        
        <hr>

        <!-- Footer -->
        <footer>
        <p class="pull-right"><a href="#">Privacy Policy </a>|<a href="#"> Terms & Conditions </a>|<a href="#"> About</a></p>
        <p>&copy; {{ date('Y') }} IceTeck, Inc.</p>
      </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script type="text/javascript" src="{{URL::to('js')}}/jquery.js"></script>
    <script type="text/javascript" src="{{URL::to('js')}}/jquery-ui.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script  type="text/javascript" src="{{URL::to('js')}}/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{URL::to('js')}}/flipper.js"></script>
    <script type="text/javascript" src="{{URL::to('js')}}/md-js.js"></script>
    <script type="text/javascript" src="{{URL::to('js')}}/card-depth.js"></script>
    <script>
      $(function() {
        $( "#accordion" ).accordion();
      });
    </script>

    <script>
      $(function() {
        $( "#tabs" ).tabs();
      });
  </script>

</body>

</html>