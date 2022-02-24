@extends('../layout/base')

@section('body')
    <body class="main">
        @include('layout.msg')
        @yield('content')

        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
        @if ($message = Session::get('success') or count($errors) > 0)
            <script>$(document).ready(function(){ window.mailersa() }); </script>
        @endif
        @yield('script')
    </body>
@endsection
