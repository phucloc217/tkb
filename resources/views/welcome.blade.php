<!DOCTYPE html>
<html>

<head>
    <title>Xếp thời khóa biểu</title>
    <link rel="icon" type="image/PNG" href="{{URL('favicon.png')}}"/>
    {{-- <link rel="stylesheet" href="{{url("build/assets/app-484413a9.css")}}"> --}}
  <script src="{{url('/jquery.slim.min.js')}}"></script>
  <script src="{{url('/bootstrap.bundle.js')}}" ></script>
  {{-- <script src="{{url('/popper.js')}}" ></script> --}}
  <script src="{{url('/bootstrap.min.js')}}" ></script>
  {{-- <script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():0 !!}
    }
</script> --}}
<script type="text/javascript">
  window.vueSpatiePermissions = {!! auth()->check() ? auth()->user()->getRolesPermissionsAsJson() : 0 !!}
</script>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app"></div>
    @vite('resources/js/app.js')
    {{-- <script type="module" src="{{url("build/assets/app-91cffe1a.js")}}"></script> --}}
</body>

</html>
