@extends('layout')

@section('title')
<title>{{__('user.Edit Property')}}</title>
@endsection

@section('meta')
<meta name="description" content="{{__('user.Edit Property')}}">
<meta name="title" content="{{__('user.Edit Property')}}">
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
                    <h2 class="breadcrumb__title m-0">{{__('user.Edit section')}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->






<section class="pd-top-20 pd-btm-10">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="/section/update/{{$section->id}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="homec-submit-form">
                        <h4 class="homec-submit-form__title">{{__('user.Basic Information')}}</h4>
                        <div class="homec-submit-form__inner">
                            <div class="row">
                                @livewireStyles
                                <livewire:cat-sub-select :category="$section->cat_id" :sub="$section->sub_id" />
                                @livewireScripts

                                <div class="row pt-3">
                                    <!-- Single Form Element -->
                                    <div class="col-lg-8 col-md-8 col-12">
                                        <h4 class="homec-submit-form__heading">{{__('user.Title')}} *</h4>
                                        <div class="form-group homec-form-input">
                                            <input type="text" name="name" id="title" required
                                                value="{{ html_decode($section->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <h4 class="homec-submit-form__heading">{{__('user.phone')}} *</h4>
                                        <div class="form-group homec-form-input">
                                            <input type="text" name="phone" id="title" required
                                                value="{{ html_decode($section->phone) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <!-- Single Form Element -->
                                        <div class="mg-top-20">
                                            <h4 class="homec-submit-form__heading">{{__('user.City')}} *</h4>
                                            <div class="form-group homec-form-input">
                                                <select required name="city_id"
                                                    class="homec-form-select homec-border select2">
                                                    <option value="">{{__('user.Select')}}</option>
                                                    @foreach ($cities as $city)
                                                    <option {{ $section->city_id == $city->id ? 'selected' : '' }}
                                                        value="{{ $city->id }}">{{ $city->name }}</option>
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
                                                <input type="text" name="address" required
                                                    value="{{ html_decode($section->address) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Description')}} *</h4>
                                        <div class="form-group homec-form-input">
                                            <textarea name="description" id="ckdesc1" required
                                                class="">{{ html_decode($section->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="homec-submit-form mg-top-20">
                                <h4 class="homec-submit-form__title">{{__('user.images and videos')}}</h4>
                                <div class="homec-submit-form__inner">

                                    <input id="slider_image_hideden_id" type="file" class="d-none"
                                        name="slider_images[]" multiple>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mg-top-20">
                                                <div class="homec-submit-form__upload mg-btm-10">
                                                    <p class="homec-img-video-label">{{__('user.Slider Image')}}</span>
                                                    </p>
                                                    <div class="homec-submit-form__upload-btn">
                                                        <button id="slider_image_hideden_btn" type="button"
                                                            class="homec-btn homec-btn--upload"><span>
                                                                {{__('user.Upload New Image')}}</span>

                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- Image Input -->
                                                <div class="homec-upload-images">
                                                    <div class="row">
                                                        @foreach ($existing_sliders as $existing_slider)
                                                        <div class="col-lg-4 col-md-4 col-12 image-box">
                                                            <div class="homec-upload-images__single">
                                                                <img src="{{ asset($existing_slider->image) }}">
                                                                <button data-id="{{ $existing_slider->id }}"
                                                                    class="homec-upload-images__single--edit remove_existing_image"><img
                                                                        src="{{ asset('frontend/img/delete-icon.svg') }}"></button>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mg-top-20">
                                                <p class="homec-img-video-label mg-btm-10">
                                                    {{__('user.Thumbnail Image')}}</p>
                                                <!-- Image Input -->
                                                <div class="homec-image-video-upload homec-border homec-bg-cover"
                                                    style="background-image: url({{ asset($section->image) }});">
                                                    <div class="homec-overlay homec-overlay--img-video"></div>
                                                    <input type="file" class="btn-check" name="thumbnail_image"
                                                        id="input-video121">
                                                    <label class="homec-image-video-upload__label" for="input-video121">
                                                        <img src="{{ asset('frontend/img/upload-file-2.svg') }}"
                                                            alt="#">
                                                        <span
                                                            class="homec-image-video-upload__title homec-image-video-upload__title--v2">{{__('user.Please')}}
                                                            <span class="homec-primary-color">
                                                                {{__('user.Choose File')}}</span>
                                                            {{__('user.to upload')}} </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <label for=""></label>
                                                <input type="file" accept=".pdf" name="pdf_file"
                                                    value="{{ $section->file }}">
                                            </div>

                                            <div class="mt-4 col-md-6 col-12">

                                                <!-- Single Form Element -->
                                                <div class="mg-top-20 ">
                                                    <h4 class="homec-submit-form__heading">
                                                        {{__('user.Youtube video id')}}
                                                    </h4>
                                                    <div class="form-group homec-form-input">
                                                        <input type="text" name="video_id"
                                                            value="{{ html_decode($section->video_id) }}">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="homec-submit-form mg-top-40 d-none">
                                <h4 class="homec-submit-form__title">{{__('user.Property Video')}}</h4>
                                <div class="homec-submit-form__inner">

                                </div>
                            </div>

                            <div class="homec-submit-form mg-top-40 d-none">
                                <h4 class="homec-submit-form__title">{{__('user.Property Location')}}</h4>
                                <div class="homec-submit-form__inner">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-end mg-top-40">
                                    <button type="submit"
                                        class="homec-btn homec-btn__second"><span>{{__('user.Submit')}}</span></button>
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


<script>
    (function($) {
        "use strict";
        $(document).ready(function () {

             // slider box load

             $("#slider_image_hideden_btn").on("click", function(){
                $('#slider_image_hideden_id').click();
            })

             // slider box load


            // slug generate and check

            $("#title").on("keyup",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            // slug generate and check

            // manage rent period price

            $("#purpose").on("change",function(){
                var purpose = $(this).val()
                if(purpose == 'rent'){
                    $("#rend_period_box").removeClass('d-none');
                }else{
                    $("#rend_period_box").addClass('d-none');
                }
            })

            // manage rent period price

            //start dynamic nearest place add and remove

            $("#addNearestPlaceRow").on("click",function(){
                var new_row=$("#hidden-location-box").html();
                $("#nearest-place-box").append(new_row)
            })

            $(document).on('click', '.removeNearestPlaceRow', function () {
                $(this).closest('.delete-dynamic-location').remove();
            });

            $(document).on('click', '.existingRemoveNearestPlaceRow', function () {

                let id = $(this).data('id');
                $(this).closest('.delete-dynamic-location').remove();

                $.ajax({
                    type:"put",
                    data: { _token : '{{ csrf_token() }}' },
                    url:"{{url('/user/remove-nearest-location/')}}"+"/"+id,
                    success:function(response){},
                    error:function(err){}
                })
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

            $(document).on('click', '.existingRemoveAdditioanRow', function () {

                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                let id = $(this).data('id');
                $(this).closest('.delete-dynamic-additio').remove();

                $.ajax({
                    type:"put",
                    data: { _token : '{{ csrf_token() }}' },
                    url:"{{url('/user/remove-add-infor/')}}"+"/"+id,
                    success:function(response){},
                    error:function(err){}
                })

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

            $(document).on('click', '.existingRemovePlanRow', function () {
                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                let id = $(this).data('id');
                $(this).closest('.delete-dynamic-plan').remove();
                $.ajax({
                    type:"put",
                    data: { _token : '{{ csrf_token() }}' },
                    url:"{{url('/user/remove-plan/')}}"+"/"+id,
                    success:function(response){

                    },
                    error:function(err){}
                })
            });

            //end dynamic plan  add and remove

            // load plan image

            $(document).on('click', '.plan-video-id', function () {
                $(this).siblings('input[type="file"]').click();
            });

            // load plan image

            // remove existing slider

            $(".remove_existing_image").on("click", function(){

                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                let id = $(this).data('id');
                let parent_div =$(this).closest('.image-box').remove();

                $.ajax({
                    type:"put",
                    data: { _token : '{{ csrf_token() }}' },
                    url:"{{url('/user/remove-property-slider/')}}"+"/"+id,
                    success:function(response){},
                    error:function(err){}
                })
                })

                // remove existing slider

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