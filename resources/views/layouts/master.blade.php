<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<title>Blood Guys Invoice System</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">	
<link rel="stylesheet" href="/css/site.css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<!--<link rel="stylesheet" href="/css/dropzone.css" />-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
 
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type = "button" class = "navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>            
        </button>
        <a class="navbar-brand" href = "#">Blood Guys</a>
    </div>
    
    <div class="collapse navbar-collapse" id="navigation">           
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::guest())
          <li><a href="/auth/login">Login</a></li>
          <li><a href="/auth/register">Register</a></li>
        @endif
               
        @if(Auth::user())
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('invoices.index')}}">Invoices</a></li>
        <li class="dropdown">                 
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin<span class="caret"></span></a>               
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('hospitals.index')}}">Hospitals</a></li>           
            <li><a href="{{route('professions.index')}}">Professions</a></li>
            <li><a href="{{route('professionals.index')}}">Professionals</a></li>           
          </ul>
        </li>
        <li><a href="/auth/logout">Logout</a></li>
        @endif       
       </ul>       
    </div>
  </div>
</nav>
 
<main>
    <div class="container">      
          @yield('content')      
    </div>
</main>
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>	
{!! Html::script('js/dropzone.js') !!}
@yield('footer')
</body>
</html>