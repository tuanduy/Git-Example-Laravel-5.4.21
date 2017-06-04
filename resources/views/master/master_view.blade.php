<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('templete/css/mystyle.css')}}">

  </head>
  <body>
    <div  id="wrapper">
      <div  id="header">
        @section('sidebar')
          Đây là menu
        @show
      </div>
      <div  id="content">
        @yield('noidung')
      </div>
      <div  id="footer">
        fsd
      </div>
    </div>
  </body>
</html>
