@extends('layout')

@section('title')
<title>IQ mulk</title>
@endsection

@section('meta')

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
                    <h2 class="breadcrumb__title m-0">{{__('user.Property Details')}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<section class="pd-top-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="homec-property-slides">
                    <div class="homec-property-main">
                        <div class="flexslider" id="f1">
                            <ul class="slides">
                                @foreach($sliders as $index => $slider)
                                <li>
                                    <div class="homec-image-gallery">
                                        <!-- Amount Card -->
                               
                                        <!-- End Amount Card -->
                                        <div class="homec-overlay"></div>
                                        <img src="{{ asset($slider->image) }}" alt="#">
                                        <div class="homec-image-gallery__bottom">
                                            <div class="homec-image-gallery__content">
                                                <h3 class="homec-image-gallery__title">{{ $section->name }}</h3>
                                                <p class="homec-image-gallery__text">
                                                    <img src="{{ asset('frontend/img/map-icon.svg')}}" alt="#">
                                                    {{ $section->city->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="homec-property-thumbs--top">
                            <div class="homec-property-thumbs mg-top-10">
                                <div class="flexslider carousel" id="f2">
                                    <ul class="slides">
                                        @foreach($sliders as $index => $slider)
                                        <li>
                                            <div class="single-thumbs">
                                                <img src="{{ asset($slider->image) }}" alt="thumbs">
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section class="pd-top-0 homec-bg-third-color pd-btm-80 homec-bg-cover homec-property-single-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ol-12">
                <div class="list-group homec-list-tabs homec-list-tabs--v2" id="list-tab" role="tablist">
                    <a class="list-group-item active" data-bs-toggle="list" href="#homec-pd-tab1"
                        role="tab">{{__('user.Property Details')}}</a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab2"
                        role="tab">{{__('user.Property Plan')}}</a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab3"
                        role="tab">{{__('user.Video')}} </a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab4"
                        role="tab">{{__('user.Locations')}} </a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab5"
                        role="tab">{{__('user.Review')}}</a>
                </div>

                <div class="homec-pdetails-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <!--  Property Details -->
                        <div class="tab-pane fade show active" id="homec-pd-tab1" role="tabpanel">
                            <div class="homec-pdetails-tab__inner">
                                {!! html_decode(clean($section->description)) !!}



                            </div>
                        </div>
                        <!--  End Property Details -->
                        <!--  Floor Plans -->

                        <!--  End Floor Plans -->
                        <!--  Property Video -->
                        <div class="tab-pane fade" id="homec-pd-tab3" role="tabpanel">
                            <div class="homec-pdetails-tab__inner">

                                <!-- Homec Features -->
                                <div class="homec-ptdetails-video">
                                    <div class="homec-overlay"></div>

                                    <div class="homec-ptdetails-video__video">


                                            <div class="homec-btn__inside">
                                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M24 45.6001C35.9293 45.6001 45.6001 35.9296 45.6001 24C45.6001 12.0707 35.9296 2.39995 24 2.39995C12.0707 2.39995 2.39995 12.0707 2.39995 24C2.39995 35.9293 12.0707 45.6001 24 45.6001ZM24 48C37.2547 48 48 37.2547 48 24C48 10.7451 37.2547 0 24 0C10.7451 0 0 10.7451 0 24C0 37.2547 10.7451 48 24 48Z"
                                                        fill="#111111" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M30.2363 24L19.1998 16.6424V31.3579L30.2363 24ZM32.4661 22.6023C33.4637 23.2673 33.4637 24.733 32.4661 25.3981L19.4115 34.1013C18.2951 34.8456 16.7996 34.0451 16.7996 32.7033V15.297C16.7996 13.9552 18.2951 13.1549 19.4115 13.8993L32.4661 22.6023Z"
                                                        fill="#111111" />
                                                </svg>
                                                <span>{{__('user.Play Video')}}</span>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                                <!-- End Homec Features -->
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    (function($) {
            "use strict";
            $(document).ready(function () {
                $("#agentEmailForm").on('submit', function(e){
                    e.preventDefault();
                    var isDemo = "{{ env('APP_MODE') }}"
                    if(isDemo == 'DEMO'){
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    $("#agentEmailBtnId").attr('disabled', true);
                    $.ajax({
                        type: 'POST',
                        data: $('#agentEmailForm').serialize(),
                        url: "{{ route('send-mail-to-agent') }}",
                        success: function (response) {
                            if(response.status == 1){
                                toastr.success(response.message)
                                $("#agentEmailForm").trigger("reset");
                                $("#agentEmailBtnId").attr('disabled', false);
                            }
                        },
                        error: function(response) {
                            $("#agentEmailBtnId").attr('disabled', false);
                            if(response.responseJSON.errors.name)toastr.error(response.responseJSON.errors.name[0])
                            if(response.responseJSON.errors.email)toastr.error(response.responseJSON.errors.email[0])
                            if(response.responseJSON.errors.subject)toastr.error(response.responseJSON.errors.subject[0])
                            if(response.responseJSON.errors.message)toastr.error(response.responseJSON.errors.message[0])
                            if(response.responseJSON.errors.agent_email)toastr.error(response.responseJSON.errors.agent_email[0])

                            if(!response.responseJSON.errors.name && !response.responseJSON.errors.email && !response.responseJSON.errors.subject && !response.responseJSON.errors.message && !response.responseJSON.errors.agent_email){
                                toastr.error("{{__('user.Please complete the recaptcha to submit the form')}}")
                            }
                        }
                    });
                })


                $("#reviewForm").on('submit', function(e){
                    e.preventDefault();
                    var isDemo = "{{ env('APP_MODE') }}"
                    if(isDemo == 'DEMO'){
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }
                    $.ajax({
                        type: 'POST',
                        data: $('#reviewForm').serialize(),
                        url: "{{ route('store-property-review') }}",
                        success: function (response) {
                            if(response.status == 1){
                                toastr.success(response.message)
                                $("#reviewForm").trigger("reset");
                            }
                        },
                        error: function(response) {
                            if(response.responseJSON.errors.review)toastr.error(response.responseJSON.errors.review[0])

                            if(!response.responseJSON.errors.review){
                                toastr.error("{{__('user.Please complete the recaptcha to submit the form')}}")
                            }
                        }
                    });
                })


            });
        })(jQuery);

        function propertyReview(rating){
            $(".property_rat").each(function(){
                var property_rat = $(this).data('rating')
                if(property_rat > rating){
                    $(this).removeClass('fa-solid fa-star').addClass('fa-regular fa-star');
                }else{
                    $(this).removeClass('fa-regular fa-star').addClass('fa-solid fa-star');
                }
            })
            $("#property_rating").val(rating);
        }


</script>
@endsection
