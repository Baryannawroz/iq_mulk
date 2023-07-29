@extends('layout')

@section('title')
<title>section</title>
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
                    <h2 class="breadcrumb__title m-0">{{__('user.section Details')}}</h2>
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
                <div class="homec-section-slides">
                    <div class="homec-section-main">
                        <div class="flexslider" id="f1">
                            <ul class="slides">

                                @foreach($sliders as $index => $slider)
                                <li>
                                    <div class="homec-image-gallery">
                                        <!-- Amount Card -->
                                        <div class="homec-amount-card homec-amount-card__sticky">
                                            <h4 class="homec-amount-card__amount">{{ $currency_icon }}{{
                                                html_decode(num_format($section->price)) }}
                                                @if ($section->purpose == 'rent')
                                                <span>{{ $section->rent_period }}</span>
                                                @endif

                                            </h4>
                                        </div>
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
                        <div class="homec-section-thumbs--top">
                            <div class="homec-section-thumbs mg-top-10">
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
        <div class="row pd-top-10 pd-btm-50">
            <div class="col-12">
                <div class="pd-features">
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-1.svg') }}">
                        </div>
                        <h4 class="pd-features__title">{{__('user.Area')}}</h4>
                        <p class="pd-features__text">{{ ($section->total_area) }}{{__('user.m2')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-2.svg') }}">
                        </div>
                        <h4 class="pd-features__title">{{__('user.Unit')}}</h4>
                        <p class="pd-features__text">{{ $section->total_unit }} {{__('user.Unit')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-3.svg') }}">
                        </div>
                        <h4 class="pd-features__title">{{__('user.Bedroom')}}</h4>
                        <p class="pd-features__text">{{ $section->total_bedroom }} {{__('user.Bedroom')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-4.svg') }}">
                        </div>
                        <h4 class="pd-features__title">{{__('user.Bath Room')}}</h4>
                        <p class="pd-features__text">{{ $section->total_bathroom }} {{__('user.Bath Room')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-5.svg') }}">
                        </div>
                        <h4 class="pd-features__title">{{__('user.Garage')}}</h4>
                        <p class="pd-features__text">{{ $section->total_garage }} {{__('user.Garage')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-6.svg') }}">
                        </div>
                        <h4 class="pd-features__title">{{__('user.Kitchen')}}</h4>
                        <p class="pd-features__text">{{ $section->total_kitchen }} {{__('user.Kitchen')}}</p>
                    </div>
                    <!-- End Pd Features -->
                </div>
            </div>
        </div>
    </div>
</section>


<section class="pd-top-0 homec-bg-third-color pd-btm-80 homec-bg-cover homec-section-single-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ol-12">
                <div class="list-group homec-list-tabs homec-list-tabs--v2" id="list-tab" role="tablist">
                    <a class="list-group-item active" data-bs-toggle="list" href="#homec-pd-tab1"
                        role="tab">{{__('user.section Details')}}</a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab2" role="tab">{{__('user.section
                        Plan')}}</a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab3"
                        role="tab">{{__('user.Video')}} </a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab4"
                        role="tab">{{__('user.Locations')}} </a>
                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab5"
                        role="tab">{{__('user.Review')}}</a>
                </div>

                <div class="homec-pdetails-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <!--  section Details -->
                        <div class="tab-pane fade show active" id="homec-pd-tab1" role="tabpanel">
                            <div class="homec-pdetails-tab__inner">
                                {!! html_decode(clean($section->description)) !!}
                                <!-- Homec Features -->

                                <!-- End Homec Features -->



                            </div>
                        </div>
                        <!--  End section Details -->
                        <!--  Floor Plans -->
                        <div class="tab-pane fade" id="homec-pd-tab2" role="tabpanel">
                            <div class="homec-pdetails-tab__inner">
                                <div class="homec-accordion accordion accordion-flush" id="homec-accordion">


                                </div>
                            </div>
                        </div>
                        <!--  End Floor Plans -->
                        <!--  section Video -->
                        <div class="tab-pane fade" id="homec-pd-tab3" role="tabpanel">
                            <div class="homec-pdetails-tab__inner">
                                <p>{{ html_decode($section->video_description) }}</p>
                                <!-- Homec Features -->
                                <div class="homec-ptdetails-video">
                                    <div class="homec-overlay"></div>
                                    <img src="{{ asset($section->video_thumbnail) }}">
                                    <div class="homec-ptdetails-video__video">
                                        <a data-video-id="{{ $section->video_id }}"
                                            class="js-video-btn homec-btn homec-btn__second homec-btn__video">
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
                        <!--  End section Video -->
                        <!--  section Map -->
                        <div class="tab-pane fade" id="homec-pd-tab4" role="tabpanel">
                            <div class="homec-pdetails-tab__inner m-0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="homec-location-card mg-top-20">
                                            <div class="homec-location-card__icon">
                                                <svg width="31" height="35" viewBox="0 0 31 35" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M21.1 22.9899C24.8026 17.1798 24.3372 17.9046 24.4439 17.7531C25.7919 15.8518 26.5044 13.6139 26.5044 11.2814C26.5044 5.09565 21.4848 0 15.291 0C9.11739 0 4.0776 5.08559 4.0776 11.2814C4.0776 13.6124 4.80505 15.9088 6.19728 17.8358L9.48193 22.9899C5.97009 23.5296 0 25.1379 0 28.6791C0 29.9701 0.842569 31.8097 4.85656 33.2433C7.65937 34.2443 11.365 34.7956 15.291 34.7956C22.6324 34.7956 30.582 32.7247 30.582 28.6791C30.582 25.1373 24.6189 23.5307 21.1 22.9899ZM7.90029 16.7144C7.88908 16.6969 7.87739 16.6798 7.86515 16.6629C6.70664 15.0691 6.11641 13.1802 6.11641 11.2814C6.11641 6.18314 10.2216 2.0388 15.291 2.0388C20.3499 2.0388 24.4656 6.18498 24.4656 11.2814C24.4656 13.1833 23.8865 15.0081 22.7907 16.5599C22.6925 16.6894 23.2048 15.8935 15.291 28.3114L7.90029 16.7144ZM15.291 32.7568C7.27213 32.7568 2.0388 30.3997 2.0388 28.6791C2.0388 27.5227 4.72785 25.6213 10.6866 24.8801L14.4313 30.7561C14.6185 31.0499 14.9427 31.2277 15.2909 31.2277C15.6392 31.2277 15.9635 31.0498 16.1506 30.7561L19.8952 24.8801C25.8541 25.6213 28.5432 27.5227 28.5432 28.6791C28.5432 30.3851 23.357 32.7568 15.291 32.7568Z" />
                                                    <path
                                                        d="M15.2923 6.18457C12.4818 6.18457 10.1953 8.47109 10.1953 11.2816C10.1953 14.0921 12.4818 16.3786 15.2923 16.3786C18.1028 16.3786 20.3893 14.0921 20.3893 11.2816C20.3893 8.47109 18.1028 6.18457 15.2923 6.18457ZM15.2923 14.3398C13.606 14.3398 12.2341 12.9679 12.2341 11.2816C12.2341 9.59528 13.606 8.22337 15.2923 8.22337C16.9786 8.22337 18.3505 9.59528 18.3505 11.2816C18.3505 12.9679 16.9786 14.3398 15.2923 14.3398Z" />
                                                </svg>
                                            </div>
                                            <h4 class="homec-location-card__title">{{__('user.Address')}}</h4>
                                            <p class="homec-location-card__desc">{{ $section->city->name }} </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="homec-location-card mg-top-20">
                                            <p class="homec-location-card__text">{{
                                                html_decode($section->address_description) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="homec-gmap-canvas mg-top-30">
                                    {!! html_decode($section->google_map) !!}
                                </div>
                            </div>
                        </div>
                        <!--  End section Map -->
                        <!--  section Review -->


                        @auth('web')
                        <div class="col-12 d-flex justify-content-center mg-top-40">
                            <div class="homec-comments-form homec-comments-form--reviews">
                                <h2 class="homec-comments-form__title m-0">{{__('user.Submit your review')}}</h2>
                                <p class="homec-comments-form__text">{{__('user.Your email address will not be
                                    published. Required fields are marked')}} *</p>
                                <form id="reviewForm">

                                    @csrf
                                    <input type="hidden" name="agent_id" value="{{ $section->agent_id }}">
                                    <input type="hidden" name="section_id" value="{{ $section->id }}">
                                    <input type="hidden" id="section_rating" name="rating" value="5">

                                    <div class="row">
                                        <div class=" col-12">
                                            <div class="form-group homec-form-input homec-form-input--review">
                                                <ul class="homec-rating list-none">
                                                    <li><i onclick="sectionReview(1)" data-rating="1"
                                                            class="section_rat fa-solid fa-star"></i></li>
                                                    <li><i onclick="sectionReview(2)" data-rating="2"
                                                            class="section_rat fa-solid fa-star"></i></li>
                                                    <li><i onclick="sectionReview(3)" data-rating="3"
                                                            class="section_rat fa-solid fa-star"></i></li>
                                                    <li><i onclick="sectionReview(4)" data-rating="4"
                                                            class="section_rat fa-solid fa-star"></i></li>
                                                    <li><i onclick="sectionReview(5)" data-rating="5"
                                                            class="section_rat fa-solid fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group homec-form-input">
                                                <textarea class="ecom-wc__form-input" name="review"
                                                    placeholder="{{__('user.Type here')}}"></textarea>
                                            </div>
                                        </div>

                              --}}

                                        <div class="col-12 d-flex mg-top-20">
                                            <button type="submit"
                                                class="homec-btn homec-btn__second"><span>{{__('user.Submit
                                                    Now')}}</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
                <!--  End section Review -->
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <!-- section Agent Card -->
        <div class="homec-section-ag homec-section-ag--side homec-bg-cover homec-agent-side-cover">
            <h3 class="homec-section-ag__title">{{__('user.section Agent')}}</h3>
            <!-- section Profile -->
            {{-- <div class="homec-section-ag__author">
                <div class="homec-section-ag__author--img">
                    @if ($section_agent->image)
                    <img src="{{ asset($section_agent->image) }}" alt="image">
                    @else
                    <img src="{{ asset($default_user_avatar) }}" alt="image">
                    @endif

                </div>
                <div class="homec-section-ag__author--content">
                    <h4 class="homec-section-ag__author--title"><a
                            href="{{ route('agent', ['agent_type' => $section_agent->agent_type, 'user_name' => $section_agent->user_name]) }}">{{
                            $section_agent->name }}</a><span><a
                                href="tel:{{ $section_agent->phone }}">{{__('user.Call')}} : {{ $section_agent->phone
                                }}</a></span></h4>
                </div>
            </div> --}}

            <!-- End section Profile -->
            {{-- <form id="agentEmailForm" class="homec-section-ag__form" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" placeholder="{{__('user.Name')}}">
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="{{__('user.Email')}}">
                </div>
                <div class="form-group">
                    <input type="text" name="subject" placeholder="{{__('user.Subject')}}">
                </div>
                <div class="form-group">
                    <textarea name="message" placeholder="{{__('user.Type message')}}"></textarea>
                </div>
                @if($recaptcha_setting->status==1)
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div>
                </div>
                @endif

                <input type="hidden" name="agent_email" value="{{ $section_agent->email }}">
                <button id="agentEmailBtnId" type="submit"
                    class="homec-btn homec-btn__second homec-section-ag__button"><span>{{__('user.Send Message
                        Now')}}</span></button>
            </form> --}}
        </div>
        <!-- End section Agent Card -->
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

        function sectionReview(rating){
            $(".section_rat").each(function(){
                var section_rat = $(this).data('rating')
                if(section_rat > rating){
                    $(this).removeClass('fa-solid fa-star').addClass('fa-regular fa-star');
                }else{
                    $(this).removeClass('fa-regular fa-star').addClass('fa-solid fa-star');
                }
            })
            $("#section_rating").val(rating);
        }


</script>
@endsection
