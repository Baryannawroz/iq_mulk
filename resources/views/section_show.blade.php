@extends('layout')

@section('title')
<title>جۆرەکانی تر</title>
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
                                href="/sections/1">{{__('user.Section')}}</a></li>
                    </ul>
                    <h2 class="breadcrumb__title m-0">{{__('user.Section Details')}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<section class="pd-top-20">
    <div class="container">
        <div class="row">



            <div class="col-md-6 col-12">
                <section class="pd-top-0 homec-bg-third-color pd-btm-80 homec-bg-cover homec-property-single-bg">
                    <div class="container">
                        <div class="row">
                            <div class=" col-12">
                                <div class="list-group homec-list-tabs homec-list-tabs--v2" id="list-tab"
                                    role="tablist">
                                    <a class="list-group-item active" data-bs-toggle="list" href="#homec-pd-tab1"
                                        role="tab">{{__('user.Section Details')}}</a>
                                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab3"
                                        role="tab">{{__('user.Video')}} </a>
                                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab4"
                                        role="tab">{{__('user.Locations')}} </a>

                                </div>

                                <div class="homec-pdetails-tab">
                                    <div class="tab-content" id="nav-tabContent">

                                        <div class="tab-pane fade" id="homec-pd-tab" role="tabpanel">
                                            <div class="homec-pdetails-tab__inner">

                                                <!-- Homec Features -->
                                                <div class="homec-ptdetails-video">
                                                    <div class="homec-overlay"></div>
                                                    <img src="{{ asset($section->image) }}">
                                                    <div class="homec-ptdetails-video__video">
                                                        <a data-video-id="{{ $section->video_id }}"
                                                            class="js-video-btn homec-btn homec-btn__second homec-btn__video">
                                                            <div class="homec-btn__inside">
                                                                <svg width="48" height="48" viewBox="0 0 48 48"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                        <div class="tab-pane fade show active" id="homec-pd-tab1" role="tabpanel">
                                            <div class="homec-pdetails-tab__inner fw-bold">


                                                {!! ($section->description) !!}

                                                <div class="homec-ptdetails-features mg-top-30">
                                                    <h4 class="homec-ptdetails-features__title">
                                                        {{__('user.phone')}}</h4>
                                                    <a class="btn homec-btn btn-md" href="tel:{{ $section->phone }}">{{
                                                        $section->phone }}</a>
                                                </div>
                                                @if ($section->file)

                                                <div class="homec-ptdetails-features mg-top-30">
                                                    <h4 class="homec-ptdetails-features__title">
                                                        {{__('user.section file')}}</h4>
                                                    <a class="btn homec-btn btn-md bg-primary"
                                                        href="/{{ $section->file }}">{{ __('user.section file') }}</a>
                                                </div>
                                                @endif


                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="homec-pd-tab3" role="tabpanel">
                                            <div class="homec-pdetails-tab__inner">

                                                <!-- Homec Features -->
                                                <div class="homec-ptdetails-video">
                                                    <div class="homec-overlay"></div>
                                                    <img src="{{ asset($section->image) }}">
                                                    <div class="homec-ptdetails-video__video">
                                                        <a data-video-id="{{ $section->video_id }}"
                                                            class="js-video-btn homec-btn homec-btn__second homec-btn__video">
                                                            <div class="homec-btn__inside">
                                                                <svg width="48" height="48" viewBox="0 0 48 48"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                        <!--  End Property Video -->
                                        <!--  Property Map -->
                                        <div class="tab-pane fade" id="homec-pd-tab4" role="tabpanel">
                                            <div class="homec-pdetails-tab__inner m-0">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="homec-location-card mg-top-20">
                                                            <div class="homec-location-card__icon">
                                                                <svg width="31" height="35" viewBox="0 0 31 35"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M21.1 22.9899C24.8026 17.1798 24.3372 17.9046 24.4439 17.7531C25.7919 15.8518 26.5044 13.6139 26.5044 11.2814C26.5044 5.09565 21.4848 0 15.291 0C9.11739 0 4.0776 5.08559 4.0776 11.2814C4.0776 13.6124 4.80505 15.9088 6.19728 17.8358L9.48193 22.9899C5.97009 23.5296 0 25.1379 0 28.6791C0 29.9701 0.842569 31.8097 4.85656 33.2433C7.65937 34.2443 11.365 34.7956 15.291 34.7956C22.6324 34.7956 30.582 32.7247 30.582 28.6791C30.582 25.1373 24.6189 23.5307 21.1 22.9899ZM7.90029 16.7144C7.88908 16.6969 7.87739 16.6798 7.86515 16.6629C6.70664 15.0691 6.11641 13.1802 6.11641 11.2814C6.11641 6.18314 10.2216 2.0388 15.291 2.0388C20.3499 2.0388 24.4656 6.18498 24.4656 11.2814C24.4656 13.1833 23.8865 15.0081 22.7907 16.5599C22.6925 16.6894 23.2048 15.8935 15.291 28.3114L7.90029 16.7144ZM15.291 32.7568C7.27213 32.7568 2.0388 30.3997 2.0388 28.6791C2.0388 27.5227 4.72785 25.6213 10.6866 24.8801L14.4313 30.7561C14.6185 31.0499 14.9427 31.2277 15.2909 31.2277C15.6392 31.2277 15.9635 31.0498 16.1506 30.7561L19.8952 24.8801C25.8541 25.6213 28.5432 27.5227 28.5432 28.6791C28.5432 30.3851 23.357 32.7568 15.291 32.7568Z" />
                                                                    <path
                                                                        d="M15.2923 6.18457C12.4818 6.18457 10.1953 8.47109 10.1953 11.2816C10.1953 14.0921 12.4818 16.3786 15.2923 16.3786C18.1028 16.3786 20.3893 14.0921 20.3893 11.2816C20.3893 8.47109 18.1028 6.18457 15.2923 6.18457ZM15.2923 14.3398C13.606 14.3398 12.2341 12.9679 12.2341 11.2816C12.2341 9.59528 13.606 8.22337 15.2923 8.22337C16.9786 8.22337 18.3505 9.59528 18.3505 11.2816C18.3505 12.9679 16.9786 14.3398 15.2923 14.3398Z" />
                                                                </svg>
                                                            </div>
                                                            <h4 class="homec-location-card__title">
                                                                {{__('user.Address')}}</h4>
                                                            <p class="homec-location-card__desc">{{
                                                                html_decode($section->address) }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="homec-gmap-canvas mg-top-30">
                                                    {!! html_decode($section->google_map) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <!--  End Property Map -->
                                        <!--  Property Review -->
                                        <div class="tab-pane fade" id="homec-pd-tab5" role="tabpanel">
                                            <div class=" col-12">
                                                <!-- Property Agent Card -->
                                                <div
                                                    class="homec-property-ag homec-property-ag--side homec-bg-cover homec-agent-side-cover">
                                                    <h3 class="homec-property-ag__title">{{__('user.Property Agent')}}
                                                    </h3>
                                                    <!-- Property Profile -->
                                                    {{-- <div class="homec-property-ag__author">
                                                        <div class="homec-property-ag__author--img">
                                                            @if ($property_agent->image)
                                                            <img src="{{ asset($property_agent->image) }}" alt="image">
                                                            @else
                                                            <img src="{{ asset($default_user_avatar) }}" alt="image">
                                                            @endif

                                                        </div>
                                                        <div class="homec-property-ag__author--content">
                                                            <h4 class="homec-property-ag__author--title"><a
                                                                    href="{{ route('agent', ['agent_type' => $property_agent->agent_type, 'user_name' => $property_agent->user_name]) }}">{{
                                                                    $property_agent->name }}</a><span><a
                                                                        href="tel:{{ $property_agent->phone }}">{{__('user.Call')}}
                                                                        : {{
                                                                        $property_agent->phone }}</a></span></h4>
                                                        </div>
                                                    </div> --}}

                                                    <!-- End Property Profile -->

                                                </div>
                                                <!-- End Property Agent Card -->
                                            </div>
                                        </div>
                                        <!--  End Property Review -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-6 col-12">
                <div class="homec-property-slides">
                    <div class="homec-property-main">
                        <div class="flexslider" id="f1">
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">

                                    @foreach($sliders as $index => $slider)

                                    @if($loop->iteration==1)
                                    <div class="carousel-item active">
                                        <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="...">
                                    </div>
                                    @else
                                    <div class="carousel-item">
                                        <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="...">
                                    </div>
                                    @endif
                                    @endforeach

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
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
