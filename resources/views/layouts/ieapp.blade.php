<!DOCTYPE html>
<html lang="en">
<head>
    <title>Income Expense Tracker</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Income Expense Tracker">
    <meta name="author" content="Fakharuddin Al-Mahmud">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('inc/plugins/fontawesome/js/all.min.js')}}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('inc/css/portal.css')}}">
    <link id="theme-style" rel="stylesheet" href="{{ asset('inc/css/toastify.min.css')}}">
    <link id="theme-style" rel="stylesheet" href="{{ asset('inc/jquery.dataTables.css')}}">

    <!-- Jquery & Axios JS-->
    <script src="{{ asset('inc/js/axios.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('inc/js/toastify-js.js') }}"></script>
    <script src="{{ asset('inc/js/config.js') }}"></script>
    <script src="{{ asset('inc/jquery.dataTables.js') }}"></script>

    <!-- Javascript -->
    <script src="{{ asset('inc/plugins/popper.min.js')}}"></script>
    <script src="{{ asset('inc/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

</head>

<body class="app">
<header class="app-header fixed-top">
    @include('layouts.header');
    @include('layouts.sidebar');

</header><!--//app-header-->

<div class="app-wrapper">

    @yield('content')



</div><!--//app-wrapper-->

@include('layouts.footer')



{{--<!-- Charts JS --}}
{{--<script src="{{ asset('assets/plugins/chart.js/chart.min.js')}}"></script>--}}
{{--<script src="{{ asset('inc/js/index-charts.js')}}"></script> -->--}}

{{--<!-- Page Specific JS -->--}}
{{--<script src="{{ asset('inc/js/app.js')}}"></script>--}}

</body>
</html>
