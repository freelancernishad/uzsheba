<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>:: উপজেলা পরিষদ সেবা সিস্টেম ::</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/bangladesh-govt.png') }}" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"> --}}
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/css/normalize.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/css/main.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/css/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/css/all.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/fonts/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard_asset/style.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css?ver=1.0.0') }}">
    <link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">
<style>

.page-item.active .page-link {

    background-color: var(--defaultColor) !important;
    border-color: var(--defaultColor) !important;
}
.page-link {

    color: var(--defaultColor) !important;

}
li.page-item.active button {
    color: white !important;
}

.a.btn.btn-info,.btn.btn-primary {
    padding: 4px 15px;
    font-size: 25px;
}

.sidebar-main.sidebar-menu-one.sidebar-expand-md.sidebar-color {
    height: 100vh !important;
}


</style>
    {{-- <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.semanticui.min.css"> --}}

</head>
<body style="font-family: 'Kalpurush', sans-serif;">

    @php
     $users = Auth::user();
    //  $users['words'] = json_decode($users->words);

        // die();
    @endphp


    <div id="app">
        <component :is="$route.meta.layout || 'div'"   :user="{{$users}}" >
            <router-view />
          </component>

</div>




<script src="{{ asset('js/backend.js?ver=1.0.82') }}"></script>




<!-- Popper js -->
<script src="{{ asset('dashboard_asset/js/popper.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('dashboard_asset/js/bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('js/datatables.min.js') }}"></script> --}}
</body>
</html>


