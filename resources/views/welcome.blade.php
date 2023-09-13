<!DOCTYPE html>
<html>

<head>
  <script src="{{url('/jquery.slim.min.js')}}"></script>
  <script src="{{url('/bootstrap.bundle.js')}}" ></script>
  {{-- <script src="{{url('/popper.js')}}" ></script> --}}
  <script src="{{url('/bootstrap.min.js')}}" ></script>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app"></div>
    @vite('resources/js/app.js')
</body>

</html>
