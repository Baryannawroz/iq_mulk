@php
$error_404=App\Models\ErrorPage::find(1);

$mobile_app = (object) array(
'app_bg' => $setting->app_bg,
'full_title' => $setting->app_full_title,
'description' => $setting->app_description,
'play_store' => $setting->google_playstore_link,
'app_store' => $setting->app_store_link,
'image' => $setting->app_image,
'apple_btn_text1' => $setting->apple_btn_text1,
'apple_btn_text2' => $setting->apple_btn_text2,
'google_btn_text1' => $setting->google_btn_text1,
'google_btn_text2' => $setting->google_btn_text2,
);

@endphp

@extends('layout')
@section('title')
<title>{{ $error_404->page_name }}</title>
@endsection
@section('meta')
<title>{{ $error_404->page_name }}</title>
@endsection

@section('frontend-content')

<!-- Breadcrumbs -->
<section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
    <!-- <div class="homec-overlay"></div> -->
    <div class="container">
        <div class="row">
            <!-- Breadcrumb-Content -->
            <div class="col-12">
                <div class="breadcrumb-content">
                    <ul class="breadcrumb__menu list-none">
                        <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                        <li class="active"><a href="javascript:;">{{ $error_404->page_name }}</a></li>
                    </ul>
                    <h2 class="breadcrumb__title m-0">{{ $error_404->page_name }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<!-- Error Page -->
<section class="homec-error section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="homec-error-inner">
                    <!-- Eror Content Image -->
                    <div class="homec-error-inner__img">
                        <img src="{{ asset($error_404->image) }}" alt="#">
                    </div>
                    <h1 class="homec-error-inner__title">{{ $error_404->header }}</h1>
                    <div class="homec-error-inner__button">
                        <a href="{{ route('home') }}" class="homec-btn"><span>{{ $error_404->button_text }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Error Page -->



<!-- End Download App -->

@endsection