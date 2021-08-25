<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ setting('general.name') . ' | Admin Area | ' }} @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

	<link rel="icon" href="{{asset('logo/'.setting('general.logo'))}}" type="image/x-icon"/>
    <meta name="keywords" content="{{ setting('general.tags') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- text editor -->
{{--    <link href="{{asset('backend/build/keditor.min.css')}}" rel="stylesheet">--}}
    <link href="{{asset('backend/build/css/keditor.min.css')}}" rel="stylesheet">


    <!-- Fonts and icons -->
	<script src="{{asset('backend/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('backend/css/fonts.min.css')}}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

	<!-- CSS Files -->
	{{-- <!-- CSS Files --> --}}
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/atlantis.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/selectize.bootstrap3.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('backend/css/demo.css')}}">

    <style >
        .social-share .lang:hover::before{
            background-color: #EC5538;
            width: 80px;
            height: 20px;
            color: #fff;
            content: '{{__('English')}}';

        }

    </style>

</head>
<body>
<div class="wrapper">

    @include('admin.layout.navbar')
    @include('admin.layout.sidebar')

    <div class="main-panel">
        <div class="content">
            @include('admin.elements.flash')
            @include('sweetalert::alert')
            @yield('content')
        </div>
            @include('admin.layout.footer')
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('backend/js/core/jquery.3.2.1.min.js')}}"></script>

<script src="{{asset('backend/js/core/popper.min.js')}}"></script>
<script src="{{asset('backend/js/core/bootstrap.min.js')}}"></script>
<!-- jQuery UI -->
<script src="{{asset('backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{asset('backend/js/atlantis.min.js')}}"></script>
<script src="{{asset('backend/js/setting-demo2.js')}}"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.3/js/bootstrap.min.js" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<!-- Datatables -->
<script src="{{asset('backend/js/plugin/datatables/datatables.min.js')}}"></script>

<script src="{{asset('backend/src/lang/index.js')}}"></script>
<script src="{{asset('backend/js/selectize.js')}}"></script>
<script src="{{asset('vendor/plupload/plupload.min.js')}}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@yield('script')
</body>
</html>
