
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
                            <li class="active"><a href="{{ route('agents') }}">{{__('user.Our Agents')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Our Agents')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Agents -->
    <section class="pd-top-70 pd-btm-100">
        <div class="container">
            <div class="row">
                @foreach ($agents as $single_agent)
                    <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="400">
                        <!-- Single agent-->
                        <div class="homec-agent homec-agent__grid homec-border mg-top-30">
                            <!-- Agent Head-->
                            <div class="homec-agent__head">
                                @if ($single_agent->image)
                                <img src="{{ asset($single_agent->image) }}" alt="agent">
                                @else
                                <img src="{{ asset($default_user_avatar) }}" alt="agent">
                                @endif
                                <ul class="homec-agent__social list-none">
                                    @if ($single_agent->linkedin)
                                        <li><a href="{{ html_decode($single_agent->linkedin) }}"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif

                                    @if ($single_agent->twitter)
                                    <li><a href="{{ html_decode($single_agent->twitter) }}"><i class="fab fa-twitter"></i></a></li>
                                    @endif

                                    @if ($single_agent->instagram)
                                    <li><a href="{{ html_decode($single_agent->instagram) }}"><i class="fab fa-instagram"></i></a></li>
                                    @endif

                                    @if ($single_agent->facebook)
                                    <li><a href="{{ html_decode($single_agent->facebook) }}"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <!-- Agent Body -->
                            <div class="homec-agent__body">
                                <h4 class="homec-agent__title"><a href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => html_decode($single_agent->user_name)]) }}">{{ html_decode($single_agent->name) }}<span>{{ html_decode($single_agent->designation) }}</span></a></h4>
                            </div>
                            <!-- End Agent Body -->
                        </div>
                        <!-- End Single agent-->
                    </div>
                @endforeach
            </div>
            <div class="row mg-top-40">
                {{ $agents->links('custom_pagination') }}
            </div>
        </div>
    </section>
    <!-- End Agents -->

    <!-- Faq Area -->
    <section class="homec-bg-cover pd-top-90 pd-btm-120 homec-faq-bg">
        <div class="container homec-container-medium">
            <div class="row homec-container-medium__row align-items-center">
                <div class="col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                    <div class="homec-section__head">
                        <div class="homec-section__shape">
                            <span class="homec-section__badge homec-section__badge--shape homec-section__badge--shape--v2">{{ $faq->content->short_title }}</span>
                        </div>
                        <h2 class="homec-section__title">{{ $faq->content->long_title }}</h2>
                    </div>
                    <div class="homec-accordion accordion accordion-flush" id="homec-accordion">

                        @foreach ($faq->faqs as $faq_index => $faq_item )

                        <!-- End Single Accordion -->
                        <div class="accordion-item homec-accordion__single mg-top-30 {{ $faq_index == 0 ? 'active' : '' }}">
                            <h2 class="accordion-header" id="homect-1-{{ $faq_index }}">
                                <button class="accordion-button collapsed homec-accordion__heading" type="button" data-bs-toggle="collapse" data-bs-target="#ac-collapse1-{{ $faq_index }}">{{ $faq_item->question }}</button>
                            </h2>
                            <div id="ac-collapse1-{{ $faq_index }}" class="accordion-collapse collapse {{ $faq_index == 0 ? 'show' : '' }}"  data-bs-parent="#homec-accordion">
                                <div class="accordion-body homec-accordion__body">{!! nl2br($faq_item->answer) !!}</div>
                            </div>
                        </div>
                        <!-- End Single Accordion -->
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="600">
                    <!-- Support Img -->
                    <div class="homec-support-img">
                        <img src="{{ asset($faq->content->support_image) }}" alt="support_image">
                        <div class="homec-support-img__content">
                            <img src="{{ asset('frontend/img/support-icon-white.svg') }}" alt="support_image">
                            <h4 class="homec-support-img__title">{{ $faq->content->support_time }} <span>{{ $faq->content->support_title }}</span>
                            </h4>
                        </div>
                    </div>
                    <!-- End Support Img -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Faq Area -->

    <!-- Download App -->
    <section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15" style="background-image:url({{ asset($mobile_app->app_bg) }})">
        <div class="homec-shape">
            <div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
            <div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
            <div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="download-app__middle">
                        <div class="download-app__content">
                            <div class="homec-section__head section-white mg-btm-30" data-aos="fade-up" data-aos-delay="400">
                                <h2 class="homec-section__title">{{ $mobile_app->full_title }}</h2>
                                <p class="sec-head__text">{{ $mobile_app->description }}</p>
                            </div>
                            <!-- App Download Button -->
                            <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                                <a href="{{ $mobile_app->app_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-apple"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->apple_btn_text1 }}</span><p>{{ $mobile_app->apple_btn_text2 }}</p></div>
                                    </div>
                                </a>
                                <a href="{{ $mobile_app->play_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-google-play"></i>
                                        <div class="btn-content"><span>{{ $mobile_app->google_btn_text1 }}</span><p>{{ $mobile_app->google_btn_text2 }}</p></div>
                                    </div>
                                </a>
                            </div>
                            <!-- End App Download Button -->
                        </div>
                        <!-- Download Image -->
                        <div class="download-app__img" data-aos="fade-up" data-aos-delay="700">
                            <img src="{{ asset($mobile_app->image) }}" alt="mobile_app">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Download App -->

@endsection
