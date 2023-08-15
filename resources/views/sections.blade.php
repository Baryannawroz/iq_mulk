@extends('layout')

@section('title')
<title>{{ $seo_setting->seo_title }}</title>
@endsection

@section('meta')
<meta name="description" content="{{ $seo_setting->seo_description }}">
<meta name="title" content="{{ $seo_setting->seo_title }}">
<meta name="keywords" content="{{ $seo_setting->seo_title }}">
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
                        <li class="active"><a
                                href="{{ route('properties',['purpose' => 'any']) }}">{{__('user.Properties')}}</a></li>
                    </ul>
                    @if (request()->has('top_property'))
                    <h2 class="breadcrumb__title m-0">{{__('user.Top Properties')}}</h2>
                    @elseif (request()->has('urgent_property'))
                    <h2 class="breadcrumb__title m-0">{{__('user.Urgent Properties')}}</h2>
                    @elseif (request()->has('featured_property'))
                    <h2 class="breadcrumb__title m-0">{{__('user.Featured Properties')}}</h2>
                    @else
                    <h2 class="breadcrumb__title m-0">{{__('user.Properties')}}</h2>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<!-- Property -->
<section class="homec-propertys pd-top-80 pd-btm-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Proeprty Bar -->
                <div class="homec-property-bar text-center d-flex justify-content-center">
                    <!-- Use "d-flex" and "justify-content-center" classes to center the child element -->
                    <p class="h3">{{ __("user.Sections") }}</p>
                </div>
                <!-- End Proeprty Bar -->
            </div>
        </div>

        <form id="propertySearchForm">

            <input type="number" hidden value="{{$cat_id}}" name="cat_id">
            <input type="hidden" name="search" value="{{ request()->get('search') }}" id="search_id">

            @if (request()->has('top_property'))
            <input type="hidden" name="top_property" value="enable">
            @endif

            @if (request()->has('featured_property'))
            <input type="hidden" name="featured_property" value="enable">
            @endif

            @if (request()->has('urgent_property'))
            <input type="hidden" name="urgent_property" value="enable">
            @endif
            <div class="row">
                <div class="col-lg-4 col-12 mg-top-30">
                    <div class="property-sidebar">
                        <!-- Single Sidebar -->

                        <div class="property-sidebar__single">
                            <div class="property-sidebar__filters">
                                <h4 class="property-sidebar__title">{{__('user.type')}}</h4>
                                <div class="form-group">
                                    <select class="property-sidebar__group homec-border select2noSearch" name="sub">
                                        <option value="">{{__('user.Select')}}</option>
                                        @foreach ($subs as $sub)
                                        <option {{ request()->get('sub') == $sub->id ? 'selected' :
                                            '' }} value="{{ $sub->id }}">{{ $sub->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Sidebar -->
                        <!-- Single Sidebar -->
                        <div class="property-sidebar__single mg-top-20">
                            <div class="property-sidebar__filters">
                                <h4 class="property-sidebar__title">{{__('user.City')}}</h4>
                                <div class="form-group">
                                    <select class="property-sidebar__group homec-border select2" name="location">
                                        <option value="">{{__('user.Select')}}</option>
                                        @foreach ($cities as $city)
                                        <option {{ request()->get('location') == $city->id ? 'selected' :
                                            '' }} value="{{ $city->id }}">{{ $city->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Sidebar -->
                        <!-- Single Sidebar -->

                        <!-- End Single Sidebar -->
                        <!-- Single Sidebar -->

                        <!-- End Single Sidebar -->
                        <!-- Single Sidebar -->


                        <!-- End Single Sidebar -->
                        <!-- Single Sidebar -->

                        <!-- End Single Sidebar -->
                        <!-- Single Sidebar -->

                        <!-- End Single Sidebar -->

                        <!-- Single Sidebar -->

                        <!-- End Single Sidebar -->


                    </div>

                </div>
                <div class="col-lg-8 col-12">
                    <div class="spinner_hidden_box d-none">
                        <div class="tab-pane fade show active" id="homec-grid" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <img class="spinner-element" src="{{ asset('uploads/website-images/Spinner.gif') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="homec-list" role="tabpanel">
                            <div class="row">
                                <img class="spinner-element" src="{{ asset('uploads/website-images/Spinner.gif') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="nav-tabContent">

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Property -->

@php
$price_min_value = 0;
$price_max_value = 2000;

if(request()->has('min_price')){
$price_min_value = request()->get('min_price');
}
if(request()->has('max_price')){
$price_max_value = request()->get('max_price');
}
@endphp

<script>
    let grid_view = true;
    (function($) {
        "use strict";
        $(document).ready(function () {

            loadPropertyWithAjax();

            let max_area = 4000;
            let max_price = 4000;
            let price_min_value = 4000;
            let price_max_value = 4000;

			$("#slider-range").slider({
				range: true,
				min: 0,
				max: max_area,
				values: [0, max_area],
				slide: function(event, ui) {
                    let text_val = `${ui.values[0]} {{__('user.m2')}} - ${ui.values[1]} {{__('user.m2')}}`
					$("#amount").val(text_val);

                    $("#min_area").val(ui.values[0]);
                    $("#max_area").val(ui.values[1]);
				}
			});

            let loading_time_text = `${$("#slider-range").slider("values", 0)} {{__('user.m2')}} - ${$("#slider-range").slider("values", 1)} {{__('user.m2')}}`;

			$("#amount").val(loading_time_text);

			$("#slider-range__v2").slider({
				range: true,
				min: 0,
				max: max_price,
				values: [price_min_value, price_max_value],
				slide: function(event, ui) {
                    let price_text = `{{ $currency_icon }}${ui.values[0]} - {{ $currency_icon }}${ui.values[1]}`
			        $("#amount-2").val(price_text);

                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);

				}
			});

            let loading_time_price_text = `{{ $currency_icon }}${$("#slider-range__v2").slider("values", 0)} - {{ $currency_icon }}${$("#slider-range__v2").slider("values", 1)}`

			$("#amount-2").val(loading_time_price_text);


            $("#searchPropertyBtn").on("click", function(e){
                $("#propertySearchForm").submit();
            })

            $("#search_input").on("keyup", function(e){
                $("#search_id").val(e.target.value);
            })

            $("select").on("change", function(){
                $("#propertySearchForm").submit();
            })

            $('input[type="checkbox"]').on("change", function(){
                setTimeout(function() {
                    $("#propertySearchForm").submit();
                }, 500);
            })

            $("#propertySearchForm").on("submit", function(e){
                e.preventDefault();
                let spinner_box = $(".spinner_hidden_box").html();
                $('#nav-tabContent').html(spinner_box);

                $.ajax({
                    type: 'get',
                    data: $('#propertySearchForm').serialize(),
                    url: "{{ route('sections-with-ajax') }}",
                    success: function (response) {
                        $('#nav-tabContent').html(response);
                    },
                    error: function(err) {}
                });

            })

            $(".list_view").on("click", function(){
                $(".grid_body").removeClass('show active');
                $(".list_body").addClass('show active');
            })

            $(".grid_view").on("click", function(){
                $(".grid_body").addClass('show active');
                $(".list_body").removeClass('show active');
            })

        });
    })(jQuery);

    function loadPropertyWithAjax(){

        let spinner_box = $(".spinner_hidden_box").html();
        $('#nav-tabContent').html(spinner_box);

        let currentURL = window.location.href
        let index = currentURL.indexOf("?");
        currentURL = currentURL.substr(index+1)
        let url = "{{ url('sections-with-ajax') }}" + "?" + currentURL;

       $.ajax({
    type: 'GET',
    data: { cat_id: "{{ $cat_id }}" }, // Corrected data option
    url: url,
    success: function (response) {
    $('#nav-tabContent').html(response);
    },
    error: function (err) {
    // Handle error if needed
    }
    });
    }

    function ajax_pagination(link){
        let spinner_box = $(".spinner_hidden_box").html();
        $('#nav-tabContent').html(spinner_box);
        $.ajax({
            type: 'get',
            url: link,
            success: function (response) {
                $('#nav-tabContent').html(response);
            },
            error: function(err) {}
        });
    }

</script>
@endsection
