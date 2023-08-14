@php
$setting = App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-sHale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    @yield('title')
    <title>{{__('admin.Login')}}</title>


    <link rel="stylesheet" href="{{ asset($path.'backend/css/bootstrap.min.css') }}">
    <link href="{{ asset($path.'backend/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset($path.'backend/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/components.css') }}">
    @if ($setting->text_direction == 'rtl')
    <link rel="stylesheet" href="{{ asset($path.'backend/css/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/dev_rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset($path.'toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/dev.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/clockpicker/dist/bootstrap-clockpicker.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/datetimepicker/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset($path.'backend/css/iziToast.min.css') }}">

    <script src="{{ asset($path.'backend/js/jquery-3.7.0.min.js') }}"></script>
    <style>
        .fade.in {
            opacity: 1 !important;
        }

        .tox .tox-promotion,
        .tox-statusbar__branding {
            display: none !important;
        }
    </style>

</head>
