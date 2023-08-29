@extends('layout')

@section('title')
<title>{{ html_decode($property->seo_title) }}</title>
@endsection

@section('meta')
<meta name="title" content="{{ html_decode($property->seo_title) }}">
<meta name="description" content="{{ html_decode($property->seo_meta_description) }}">
<meta name="keywords" content="{{ html_decode($property->seo_title) }}">
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
                                        role="tab">{{__('user.Property Details')}}</a>
                                    <a class="d-none list-group-item" data-bs-toggle="list" href="#homec-pd-tab2"
                                        role="tab">{{__('user.Property Plan')}}</a>
                                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab3"
                                        role="tab">{{__('user.Video')}} </a>
                                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab4"
                                        role="tab">{{__('user.Locations')}} </a>
                                    <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab5"
                                        role="tab">{{__('user.Agent')}}</a>
                                </div>

                                <div class="homec-pdetails-tab">
                                    <div class="tab-content" id="nav-tabContent">
                                        <!--  Property Details -->
                                        <div class="tab-pane fade show active" id="homec-pd-tab1" role="tabpanel">
                                            <div class="homec-pdetails-tab__inner fw-bold">


                                                {!! ($property->description) !!}

                                                <!-- Homec Features -->

                                                <!-- End Homec Features -->
                                                @if ($nearest_locations->count() > 0)
                                                <!-- Homec Features -->
                                                <div class="homec-ptdetails-features mg-top-30">
                                                    <h4 class="homec-ptdetails-features__title">{{__('user.Nearest
                                                        Location')}}</h4>
                                                    <ul class="homec-ptdetails-features__list">
                                                        @foreach ($nearest_locations as $nearest_location)
                                                        <li><b>{{ $nearest_location->location->location }}:</b> <span>{{
                                                                html_decode($nearest_location->distance)
                                                                }}{{__('user.KM')}}</span></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!-- End Homec Features -->
                                                @endif

                                                @if ($aminities->count() > 0)
                                                <!-- Homec Features -->
                                                <div class="homec-ptdetails-features mg-top-30">
                                                    <h4 class="homec-ptdetails-features__title">{{__('user.Aminities')}}
                                                    </h4>
                                                    <ul class="homec-ptdetails-features__list">
                                                        @foreach ($aminities as $aminity)
                                                        <li><b><i class="fas fa-check"></i> {{
                                                                $aminity->aminity->aminity }}</b></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!-- End Homec Features -->
                                                @endif

                                                <div class="homec-ptdetails-features mg-top-30">
                                                    <h4 class="homec-ptdetails-features__title">
                                                        {{__('user.phone')}}</h4>
                                                    <a class="btn homec-btn btn-md" href="tel:{{ $property->phone }}">{{
                                                        $property->phone }}</a>
                                                </div>

                                            </div>
                                            <div class="row mg-top-20">
                                                    <p>{{ __('user.share it') }}</p>
                                                    <div class="col-1">

                                                        <a style="cursor: pointer;" id="facebook-share-btn"><svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                                            </svg></a>
                                                    </div>
                                                    <div class="col-1">

                                                        <a style="cursor: pointer;" id="instagram-share-btn"><svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                height="32" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                            </svg></a>
                                                    </div>
                                                </div>
                                            <div class="text-danger">
                                                <p>{{ __('user.expired_date') }}</p>
                                                {{ $property->expired_date->diffForHumans() }}
                                            </div>
                                        </div>
                                        <!--  End Property Details -->
                                        <!--  Floor Plans -->
                                        <div class="tab-pane fade" id="homec-pd-tab2" role="tabpanel">
                                            <div class="homec-pdetails-tab__inner">
                                                <div class="homec-accordion accordion accordion-flush"
                                                    id="homec-accordion">

                                                    @foreach ($property_plans as $plan_index => $property_plan)
                                                    <!-- Single Accordion -->
                                                    <div
                                                        class="accordion-item homec-accordion__single homec-accordion__single--floor mg-top-20">
                                                        <h2 class="accordion-header" id="homect-1-{{ $plan_index }}">
                                                            <button
                                                                class="accordion-button collapsed homec-accordion__heading homec-accordion__heading--floor"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#ac-collapseOne-{{ $plan_index }}">{{
                                                                html_decode($property_plan->title) }}</button>
                                                        </h2>
                                                        <div id="ac-collapseOne-{{ $plan_index }}"
                                                            class="accordion-collapse collapse {{ $plan_index == 0 ? 'show' : '' }}"
                                                            aria-labelledby="homect-1-{{ $plan_index }}"
                                                            data-bs-parent="#homec-accordion">
                                                            <div
                                                                class="accordion-body homec-accordion__body homec-accordion__body--floor">
                                                                <div class="floor-plan-img">
                                                                    <img src="{{ asset($property_plan->image) }}">
                                                                </div>
                                                                <div class="floor-plan-content">
                                                                    <p>{{ html_decode($property_plan->description) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Accordion -->
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!--  End Floor Plans -->
                                        <!--  Property Video -->
                                        <div class="tab-pane fade" id="homec-pd-tab3" role="tabpanel">
                                            <div class="homec-pdetails-tab__inner">
                                                <p>{{ html_decode($property->video_description) }}</p>
                                                <!-- Homec Features -->
                                                <div class="homec-ptdetails-video">
                                                    <div class="homec-overlay"></div>
                                                    <img src="{{ asset($property->video_thumbnail) }}">
                                                    <div class="homec-ptdetails-video__video">
                                                        <a data-video-id="{{ $property->video_id }}"
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
                                                                html_decode($property->address) }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="homec-gmap-canvas mg-top-30">
                                                    {!! html_decode($property->google_map) !!}
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
                                                    <div class="homec-property-ag__author">
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
                                                    </div>

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
        <div class="row pd-top-10 pd-btm-50">
            <div class="col-12">
                <div class="pd-features">
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-1.svg') }}">
                        </div>
                        <p class="pd-features__text">{{ html_decode($property->total_area) }}{{__('user.m2')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-2.svg') }}">
                        </div>
                        <p class="pd-features__text">{{ $property->total_unit }} {{__('user.Unit')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-3.svg') }}">
                        </div>
                        <p class="pd-features__text">{{ $property->total_bedroom }} {{__('user.Bedroom')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-4.svg') }}">
                        </div>
                        <p class="pd-features__text">{{ $property->total_bathroom }} {{__('user.Bath Room')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-5.svg') }}">
                        </div>
                        <p class="pd-features__text">{{ $property->total_garage }} {{__('user.Garage')}}</p>
                    </div>
                    <!-- End Pd Features -->
                    <!-- Pd Features -->
                    <div class="pd-features__single mg-top-30">
                        <div class="pd-features__icon">
                            <img src="{{ asset('frontend/img/pd-icon-6.svg') }}">
                        </div>
                        <p class="pd-features__text">{{ $property->total_kitchen }} {{__('user.Kitchen')}}</p>
                    </div>
                    <!-- End Pd Features -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pd-top-90">
    <div class="homec-property-separate homec-bg-primary-color">
        <div class="homec-bg homec-bg__opacity homec-featured-bg-two"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="homec-flex homec-flex__section mg-btm-60">
                    <!-- Section TItle -->
                    <div class="homec-section__head m-0 mg-top-30">
                        <span class="homec-section__badge homec-second-color homec-section__badge--small m-0"
                            data-aos="fade-in" data-aos-delay="300">{{ __('user.prozhakan') }}</span>
                        <h2 class="homec-section__title text-white" data-aos="fade-in" data-aos-delay="400">
                            {{__('user.prozhakan') }}</h2>
                    </div>
                    <!-- Button -->
                    <div class="homec-section__btn mg-top-30" data-aos="fade-right" data-aos-delay="500">
                        <a href="{{ route('properties',['top_property' => 'enable']) }}"
                            class="homec-btn homec-btn__second"><span>{{__('user.see prozhakan')}}</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper mySwiper homec-slider-property pd-btm-30 loading">


            <div class="swiper-wrapper">
                @foreach ($featured_properties as $featured_property)
                <div class="swiper-slide">
                    <!-- Single property-->
                    <div class="homec-property">
                        <!-- Property Head-->
                        <div class="homec-property__head">
                            <a href="{{ route('property', html_decode($featured_property->slug)) }}">kjhj
                                <img src="{{ asset($featured_property->thumbnail_image) }}" alt="thumbnail_image">
                            </a>
                            <div class="homec-property__hsticky">

                                <span class="homec-property__salebadge mx-3">
                                    @if ($featured_property->purpose == 'rent')
                                    {{__('user.For Rent')}}
                                    @else
                                    {{__('user.For Sale')}}
                                    @endif
                                </span>

                            </div>
                            <!-- End Top Sticky -->
                        </div>
                        <!-- Property Body-->
                        <div class="homec-property__body">
                            <div class="homec-property__topbar">
                                <div class="homec-property__price">{{ $currency_icon }}{{
                                    html_decode(number_format($featured_property->price,0)) }}
                                    @if ($featured_property->purpose == 'rent')
                                    <span>/{{ __("user.". $featured_property->rent_period )}}</span>
                                    @endif

                                </div>
                            </div>
                            <h3 class="homec-property__title">
                                <a href="{{ route('property', html_decode($featured_property->slug)) }}">{{
                                    html_decode($featured_property->title) }}</a>
                            </h3>
                            <div class="homec-property__text">
                                <img src="{{ asset('frontend/img/location-icon.svg') }}" alt="address">
                                <p>{{ html_decode($featured_property->address) }}</p>
                            </div>
                            <!-- Property List-->
                            <ul class="homec-property__list homec-border-top list-none">
                                <li><img src="{{ asset('frontend/img/room-icon2.svg') }}" alt="total_bedroom">{{
                                    $featured_property->total_bedroom }} {{__('user.Bed')}}</li>
                                <li><img src="{{ asset('frontend/img/bath-icon2.svg') }}" alt="total_bathroom">{{
                                    $featured_property->total_bathroom }} {{__('user.Bath')}}</li>
                                <li><img src="{{ asset('frontend/img/size-icon2.svg') }}" alt="total_area">{{
                                    html_decode($featured_property->total_area) }} {{__('user.m2')}}</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single property-->
                </div>
                @endforeach

            </div>
        </div>
        <!-- Slider Pagination -->
        <div class="swiper-pagination swiper-pagination__property mg-top-30"></div>
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
<script>
    document.getElementById('facebook-share-btn').addEventListener('click', function() {
            const urlToShare = 'https://www.example.com'; // Replace with the URL you want to share
            const facebookShareURL = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(urlToShare)}`;

            window.open(facebookShareURL, 'Share on Facebook', 'width=600,height=400');

            document.getElementById('instagram-share-btn').addEventListener('click', function() {
                const urlToShare = 'https://www.example.com'; // Replace with the URL you want to share
                const instagramShareURL = `https://www.instagram.com/share?url=${encodeURIComponent(urlToShare)}`;

                window.open(instagramShareURL, 'Share on Instagram', 'width=600,height=400');
                });
        });
</script>
@endsection
