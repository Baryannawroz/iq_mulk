@extends('layout')

@section('title')
<title>{{__('user.Create Property')}}</title>
@endsection

@section('meta')
<meta name="description" content="{{__('user.Create Property')}}">
<meta name="title" content="{{__('user.Create Property')}}">
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
                        <li class="active"><a href="{{ route('user.dashboard') }}">{{__('user.Dashboard')}}</a></li>
                    </ul>
                    <h2 class="breadcrumb__title m-0">{{__('user.Create Property')}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<div id="hidden-location-box" class="d-none">
    <div class="delete-dynamic-location">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Single Form Element -->

            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Single Form Element -->
                <div class="mg-top-20">
                    <h4 class="homec-submit-form__heading">{{__('user.Distance(km)')}}</h4>
                    <div class="form-group homec-form-input homec-form-add">
                        <input type="text" name="distances[]" autocomplete="off">
                        <button type="button"
                            class="homec-form-add__button homec-form-add__button--delete removeNearestPlaceRow"><img
                                src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="hidden-addition-box" class="d-none">
    <div class="delete-dynamic-additio">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Single Form Element -->
                <div class="mg-top-20">
                    <h4 class="homec-submit-form__heading">{{__('user.Key')}}</h4>
                    <div class="form-group homec-form-input">
                        <input type="text" name="add_keys[]" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Single Form Element -->
                <div class="mg-top-20">
                    <h4 class="homec-submit-form__heading">{{__('user.Value')}}</h4>
                    <div class="form-group homec-form-input homec-form-add">
                        <input type="text" name="add_values[]" autocomplete="off">
                        <button type="button"
                            class="homec-form-add__button homec-form-add__button--delete removeAdditioanRow"><img
                                src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="hidden-plan-box" class="d-none">
    <div class="delete-dynamic-plan">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="mg-top-30">
                    <p class="homec-img-video-label mg-btm-10">{{__('user.Image')}}</p>
                    <!-- Image Input -->
                    <div class="homec-image-video-upload homec-border">
                        <input type="file" class="btn-check" name="plan_images[]">
                        <label class="homec-image-video-upload__label plan-video-id">
                            <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                            <span class="homec-image-video-upload__title">{{__('user.Please')}} <span
                                    class="homec-primary-color">{{__('user.Choose File')}}</span>
                                {{__('user.to upload')}} </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Single Form Element -->
                <div class="mg-top-30">
                    <h4 class="homec-submit-form__heading">{{__('user.Title')}} </h4>
                    <div class="form-group homec-form-input">
                        <input type="text" name="plan_titles[]">
                    </div>
                </div>
                <!-- Single Form Element -->
                <div class="mg-top-20 m-5">
                    <h4 class="homec-submit-form__heading">{{__('user.Description')}}</h4>
                    <div class="form-group homec-form-input homec-form-add">
                        <textarea name="plan_descriptions[]"></textarea>
                        <button type="button"
                            class="homec-form-add__button homec-form-add__button--delete removePlanRow"><img
                                src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="pd-top-20 pd-btm-20">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="/section/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="homec-submit-form">
                        <h4 class="homec-submit-form__title">{{__('user.Basic Information')}}</h4>
                        <div class="homec-submit-form__inner">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20 ">
                                        <livewire:cat-sub-select :category="-1" :sub="-1" />
                                    </div>
                                </div>
                                <div class="row mg-top-10">

                                    <div class="col-lg-8 col-md-8 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Title')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="name" id="title" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.phone')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" max="11" name="phone" id="title" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.City')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <select name="city_id" class="homec-form-select homec-border select2"
                                                    required>
                                                    <option value="">{{__('user.Select')}}</option>
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.Address')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <input type="text" name="address" required>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!-- Single Form Element -->
                                <div class=" pt-3 col-lg-12 col-md-12 col-12">
                                    <h4 class="homec-submit-form__heading">{{__('user.Description')}} *</h4>
                                    <div class="form-group homec-form-input">
                                        <textarea required name="description" id="ckdesc1" class=""></textarea>
                                    </div>
                                </div>
                            </div>





                        </div>
                    </div>
            </div>


            <div class="homec-submit-form mg-top-10">
                <h4 class="homec-submit-form__title">{{__('user.images and videos')}}</h4>
                <div class="homec-submit-form__inner">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="mg-top-20">
                                <p class="homec-img-video-label mg-btm-10">
                                    {{__('user.Thumbnail Image')}}*</span></p>
                                <!-- Image Input -->
                                <div class="homec-image-video-upload homec-border">
                                    <input required type="file" class="btn-check" id="input-video1"
                                        name="thumbnail_image">
                                    <label class="homec-image-video-upload__label" for="input-video1">
                                        <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                        <span class="homec-image-video-upload__title">{{__('user.Please')}}
                                            <span class="homec-primary-color">{{__('user.Choose File')}}</span>
                                            {{__('user.to upload')}} </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="mg-top-20">
                                <p class="homec-img-video-label mg-btm-10">{{__('user.Slider Image')}}*</p>
                                <!-- Image Input -->
                                <div class="homec-image-video-upload homec-border">
                                    <input required type="file" class="btn-check" name="slider_images[]" multiple
                                        id="input-video12">
                                    <label class="homec-image-video-upload__label" for="input-video12">
                                        <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                        <span class="homec-image-video-upload__title">{{__('user.Please')}}
                                            <span class="homec-primary-color">
                                                {{__('user.Choose File')}}</span>
                                            {{__('user.to upload')}} </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="mg-top-20">
                                <p class="homec-img-video-label mg-btm-10">
                                    {{__('user.section file')}}*</span></p>
                                <!-- Image Input -->
                                <div class="homec-image-video-upload homec-border">
                                    <input type="file" class="btn-check" accept=".pdf" name="pdf_file" id="pdf_file">
                                    <label class="homec-image-video-upload__label" for="pdf_file">
                                        <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                        <span class="homec-image-video-upload__title">{{__('user.Please')}}
                                            <span class="homec-primary-color">
                                                {{__('user.Choose File')}}</span>
                                            {{__('user.to upload')}} </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{__('user.Youtube video id')}} </h4>
                                <div class="form-group homec-form-input">
                                    <input required type="text" name="video_id">
                                </div>
                            </div>
                            <!-- Single Form Element -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="homec-submit-form mg-top-40 d-none">
                <h4 class="homec-submit-form__title">{{__('user.Property Video')}}</h4>
                <div class="homec-submit-form__inner">
                    <div class="row">


                    </div>
                </div>
            </div>

            <div class="homec-submit-form mg-top-40 d-none">
                <h4 class="homec-submit-form__title">{{__('user.Location')}}</h4>
                <div class="homec-submit-form__inner">

                </div>
            </div>

            {{-- <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{__('user.Aminities')}}</h4>
                <div class="homec-submit-form__inner">
                    <div class="form-group homec-form-input--list">
                        @foreach ($aminities as $aminity)
                        <div class="form-group homec-form-checkbox mg-top-15">
                            <input type="checkbox" id="item1-{{ $aminity->id }}" name="aminities[]"
                                value="{{ $aminity->id }}">
                            <label class="homec-form-label" for="item1-{{ $aminity->id }}">{{
                                $aminity->aminity
                                }}</label>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div> --}}



            {{-- <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{__('user.Additional Information')}}</h4>
                <div class="homec-submit-form__inner" id="additional-box">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{__('user.Key')}}</h4>
                                <div class="form-group homec-form-input">
                                    <input type="text" name="add_keys[]" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{__('user.Value')}}</h4>
                                <div class="form-group homec-form-input homec-form-add">
                                    <input type="text" name="add_values[]" autocomplete="off">
                                    <button id="addAdditionalRow" type="button" class="homec-form-add__button"><img
                                            src="{{ asset('frontend/img/plus-icon.svg') }}"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}

            {{-- <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{__('user.Property Plan')}}</h4>
                <div class="homec-submit-form__inner" id="plan-box">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="mg-top-30">
                                <p class="homec-img-video-label mg-btm-10">{{__('user.Image')}}</p>
                                <!-- Image Input -->
                                <div class="homec-image-video-upload homec-border">
                                    <input type="file" class="btn-check" name="plan_images[]">
                                    <label class="homec-image-video-upload__label plan-video-id">
                                        <img src="{{ asset('frontend/img/upload-file.svg') }}" alt="#">
                                        <span class="homec-image-video-upload__title">{{__('user.Please')}}
                                            <span class="homec-primary-color">{{__('user.Choose
                                                File')}}</span>
                                            {{__('user.to upload')}} </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-30">
                                <h4 class="homec-submit-form__heading">{{__('user.Title')}} </h4>
                                <div class="form-group homec-form-input">
                                    <input type="text" name="plan_titles[]">
                                </div>
                            </div>
                            <!-- Single Form Element -->
                            <div class="mg-top-30">
                                <h4 class="homec-submit-form__heading">{{__('user.Description')}}</h4>
                                <div class="form-group homec-form-input homec-form-add">
                                    <textarea name="plan_descriptions[]"></textarea>
                                    <button id="addNewPlan" type="button" class="homec-form-add__button"><img
                                            src="{{ asset('frontend/img/plus-icon.svg') }}"></button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="homec-submit-form mg-top-40">
                <h4 class="homec-submit-form__title">{{__('user.SEO Information')}}</h4>
                <div class="homec-submit-form__inner">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{__('user.SEO Title')}}</h4>
                                <div class="form-group homec-form-input">
                                    <input type="text" name="seo_title">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Single Form Element -->
                            <div class="mg-top-20">
                                <h4 class="homec-submit-form__heading">{{__('user.SEO Meta Description')}}
                                </h4>
                                <div class="form-group homec-form-input">
                                    <input type="text" name="seo_meta_description">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-12 d-flex justify-content-end mg-top-40">
                    <button type="submit" class="homec-btn homec-btn__second fw-bold"><span>
                            {{__('user.Submit')}}</span></button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</section>

<!-- Download App -->
{{-- <section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15"
    style="background-image:url({{ asset($mobile_app->app_bg) }})">
    <div class="homec-shape">
        <div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                alt="bg"></div>
        <div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                alt="bg"></div>
        <div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                alt="bg"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="download-app__middle">
                    <div class="download-app__content">
                        <div class="homec-section__head section-white mg-btm-30" data-aos="fade-up"
                            data-aos-delay="400">
                            <h2 class="homec-section__title">{{ $mobile_app->full_title }}</h2>
                            <p class="sec-head__text">{{ $mobile_app->description }}</p>
                        </div>
                        <!-- App Download Button -->
                        <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                            <a href="{{ $mobile_app->app_store }}"
                                class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                <div class="homec-btn__inside">
                                    <i class="fa-brands fa-apple"></i>
                                    <div class="btn-content"><span>{{ $mobile_app->apple_btn_text1 }}</span>
                                        <p>{{ $mobile_app->apple_btn_text2 }}</p>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ $mobile_app->play_store }}"
                                class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                <div class="homec-btn__inside">
                                    <i class="fa-brands fa-google-play"></i>
                                    <div class="btn-content"><span>{{ $mobile_app->google_btn_text1 }}</span>
                                        <p>{{ $mobile_app->google_btn_text2 }}</p>
                                    </div>
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
</section> --}}
<!-- End Download App -->
@livewireScripts

<script>
    (function($) {
        "use strict";
        $(document).ready(function () {

            // slug generate and check

            $("#title").on("keyup",function(e){
                let slug = convertToSlug($(this).val());
                $("#slug").val(slug);

                $.ajax({
                    type:"get",
                    url:"{{url('/admin/check-slug/')}}"+"/"+slug,
                    success:function(response){

                    },
                    error:function(err){
                        if(err.status == 403){
                            toastr.error(err.responseJSON.message);
                            $("#slug").val('');
                        }
                    }
                })
            })

            // slug generate and check

            //start dynamic nearest place add and remove

            $("#addNearestPlaceRow").on("click",function(){
                var new_row=$("#hidden-location-box").html();
                $("#nearest-place-box").append(new_row)
            })

            $(document).on('click', '.removeNearestPlaceRow', function () {
                $(this).closest('.delete-dynamic-location').remove();
            });

            //end dynamic nearest place add and remove

            //start additonal information add and remove

            $("#addAdditionalRow").on("click",function(){
                var new_row=$("#hidden-addition-box").html();
                $("#additional-box").append(new_row)
            })

            $(document).on('click', '.removeAdditioanRow', function () {
                $(this).closest('.delete-dynamic-additio').remove();
            });

            //end additonal information add and remove

            //start dynamic plan add and remove

            $("#addNewPlan").on("click",function(){
                var new_row=$("#hidden-plan-box").html();
                $("#plan-box").append(new_row)
            })

            $(document).on('click', '.removePlanRow', function () {
                $(this).closest('.delete-dynamic-plan').remove();
            });

            //end dynamic plan  add and remove

            // load plan image

            $(document).on('click', '.plan-video-id', function () {
                $(this).siblings('input[type="file"]').click();
            });

            // load plan image

        });

        })(jQuery);

        function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-');
            }
</script>


@endsection
