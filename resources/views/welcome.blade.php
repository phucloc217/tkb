<!DOCTYPE html>
<html>

<head>
    <title>Xếp thời khóa biểu</title>
  <script src="{{url('/jquery.slim.min.js')}}"></script>
  <script src="{{url('/bootstrap.bundle.js')}}" ></script>
  {{-- <script src="{{url('/popper.js')}}" ></script> --}}
  <script src="{{url('/bootstrap.min.js')}}" ></script>
  <script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():0 !!}
    }
</script>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app"></div>
    @vite('resources/js/app.js')
    {{-- <script type="module" src="{{url("assets/app-655ff770.js")}}"></script> --}}
</body>

</html>
