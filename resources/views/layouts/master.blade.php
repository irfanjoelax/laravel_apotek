<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Apotek Kim Farma</title>

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Template Styles -->
    <link rel="stylesheet" href="{{ asset('medialoot/css/font-awesome.min.css') }}">
    
    <!-- CSS Reset -->
    <link rel="stylesheet" href="{{ asset('medialoot/css/normalize.css') }}">
    
    <!-- Milligram CSS minified -->
    <link rel="stylesheet" href="{{ asset('medialoot/css/milligram.min.cs') }}s">
    
    <!-- Main Styles -->
    <link rel="stylesheet" href="{{ asset('medialoot/css/styles.css') }}">

    <!-- dataTables Styles -->
    <link rel="stylesheet" href="{{ asset('datatables/jquery.dataTables.css') }}">


</head>
<body>
    {{-- navbar --}}
    @include('layouts.partials._navbar')

    
    <div class="row">
        {{-- sidebar --}}
        @include('layouts.partials._sidebar')

        {{-- main content --}}
        <section id="main-content" class="column column-offset-20">
            @include('layouts.partials._alert')
            @yield('content')
            @include('layouts.partials._logout')
        </section>
        
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('medialoot/js/chart.min.js') }}"></script>
    <script src="{{ asset('medialoot/js/chart-data.js') }}"></script>
    @yield('script')
</body>
</html>
