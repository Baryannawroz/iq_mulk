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
                            <li class="active"><a href="{{ route('blogs') }}">{{__('user.Blogs')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Blogs')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

           <!-- Blog Area -->
		<section id="blog" class="blog-area pd-top-90 pd-btm-120">
			<div class="blog-bg-pattern">
				<div class="container">

                    @if ($blogs->count() > 0)
                        <div class="row">
                            @foreach ($blogs as $blog_index => $single_blog)
                                <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-delay="400">
                                    <!-- Single Blog -->
                                    <div class="homec-blog">
                                        <div class="homec-blog__head">
                                            <div class="homec-overlay homec-blog__overlay"></div>
                                            <a href="{{ route('blog', $single_blog->slug) }}"><img src="{{ asset($single_blog->image) }}" alt="single_blog"></a>
                                            <!-- Blog Content -->
                                            <div class="homec-blog__content">
                                                <ul class="homec-blog__meta list-none">
                                                    <li>
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.8182 12.3637H8.36367V13.8182H9.8182V12.3637Z" />
                                                            <path d="M9.8182 9.81816H8.36367V11.2727H9.8182V9.81816Z" />
                                                            <path d="M7.63637 7.27266H6.18184V8.72719H7.63637V7.27266Z" />
                                                            <path d="M7.63637 9.81816H6.18184V11.2727H7.63637V9.81816Z" />
                                                            <path d="M11.9999 9.81816H10.5454V11.2727H11.9999V9.81816Z" />
                                                            <path d="M14.1818 9.81816H12.7272V11.2727H14.1818V9.81816Z" />
                                                            <path d="M14.1818 7.27266H12.7272V8.72719H14.1818V7.27266Z" />
                                                            <path d="M11.9999 7.27266H10.5454V8.72719H11.9999V7.27266Z" />
                                                            <path d="M9.8182 7.27266H8.36367V8.72719H9.8182V7.27266Z" />
                                                            <path d="M3.2727 9.81816H1.81816V11.2727H3.2727V9.81816Z" />
                                                            <path d="M3.2727 12.3637H1.81816V13.8182H3.2727V12.3637Z" />
                                                            <path d="M14.5455 1.45453H13.0909V0.363625C13.0909 0.162812 12.9281 0 12.7273 0C12.5264 0 12.3637 0.162812 12.3637 0.363625V1.45453H3.63637V0.363625C3.63637 0.162812 3.47356 0 3.27272 0C3.07187 0 2.90909 0.162812 2.90909 0.363625V1.45453H1.45453C0.651219 1.45453 0 2.10578 0 2.90909V14.5455C0 15.3488 0.651219 16 1.45453 16H14.5454C15.3488 16 16 15.3488 16 14.5455V2.90909C16 2.10578 15.3488 1.45453 14.5455 1.45453ZM15.2727 14.5455C15.2727 14.9471 14.9471 15.2727 14.5454 15.2727H1.45453C1.05287 15.2727 0.72725 14.9471 0.72725 14.5455V5.81819H15.2727V14.5455ZM15.2727 5.09091H0.727281V2.90909C0.727281 2.50744 1.05291 2.18181 1.45456 2.18181H2.90909V3.27272C2.90909 3.47356 3.07191 3.63634 3.27272 3.63634C3.47356 3.63634 3.63634 3.47353 3.63634 3.27272V2.18181H12.3636V3.27272C12.3636 3.47356 12.5264 3.63634 12.7273 3.63634C12.9281 3.63634 13.0909 3.47353 13.0909 3.27272V2.18181H14.5454C14.9471 2.18181 15.2727 2.50744 15.2727 2.90909L15.2727 5.09091Z" />
                                                            <path d="M3.2727 7.27266H1.81816V8.72719H3.2727V7.27266Z" />
                                                            <path d="M7.63637 12.3637H6.18184V13.8182H7.63637V12.3637Z" />
                                                            <path d="M5.45453 12.3637H4V13.8182H5.45453V12.3637Z" />
                                                            <path d="M5.45453 7.27266H4V8.72719H5.45453V7.27266Z" />
                                                            <path d="M5.45453 9.81816H4V11.2727H5.45453V9.81816Z" />
                                                        </svg>
                                                        {{ $single_blog->created_at->format('M d, Y') }}
                                                    </li>
                                                    <li class="active">
                                                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.60687 8.64356C8.67386 8.64356 9.59767 8.26087 10.3527 7.50584C11.1075 6.75093 11.4903 5.82724 11.4903 4.76013C11.4903 3.69339 11.1076 2.76958 10.3526 2.01443C9.59755 1.25964 8.67374 0.876953 7.60687 0.876953C6.53976 0.876953 5.61608 1.25964 4.86117 2.01455C4.10626 2.76946 3.72345 3.69327 3.72345 4.76013C3.72345 5.82724 4.10626 6.75105 4.86117 7.50596C5.61633 8.26075 6.54013 8.64356 7.60687 8.64356ZM5.52936 2.68262C6.10861 2.10336 6.78812 1.82179 7.60687 1.82179C8.42551 1.82179 9.10514 2.10336 9.68451 2.68262C10.2638 3.26199 10.5455 3.94162 10.5455 4.76013C10.5455 5.57889 10.2638 6.25839 9.68451 6.83777C9.10514 7.41715 8.42551 7.69872 7.60687 7.69872C6.78837 7.69872 6.10886 7.41702 5.52936 6.83777C4.94998 6.25852 4.66829 5.57889 4.66829 4.76013C4.66829 3.94162 4.94998 3.26199 5.52936 2.68262Z"/>
                                                            <path d="M14.4018 13.275C14.3801 12.9609 14.336 12.6182 14.2712 12.2563C14.2057 11.8917 14.1215 11.547 14.0206 11.232C13.9163 10.9064 13.7747 10.5848 13.5994 10.2767C13.4177 9.95684 13.2042 9.67835 12.9646 9.44918C12.714 9.20944 12.4072 9.01668 12.0525 8.87608C11.6989 8.73622 11.3071 8.66536 10.888 8.66536C10.7235 8.66536 10.5643 8.73289 10.2569 8.93303C10.0677 9.05641 9.84639 9.1991 9.59939 9.35692C9.38818 9.4915 9.10206 9.61758 8.74865 9.73174C8.40386 9.84331 8.05377 9.89989 7.70811 9.89989C7.3627 9.89989 7.01261 9.84331 6.66757 9.73174C6.31453 9.61771 6.02829 9.49162 5.81745 9.35705C5.57278 9.2007 5.35136 9.05801 5.15935 8.93291C4.85219 8.73277 4.69301 8.66524 4.52843 8.66524C4.10921 8.66524 3.71755 8.73622 3.36414 8.8762C3.00962 9.01656 2.70271 9.20931 2.4519 9.4493C2.21227 9.6786 1.99873 9.95697 1.81716 10.2767C1.64212 10.5848 1.50041 10.9062 1.3961 11.2321C1.29536 11.5471 1.21109 11.8917 1.14565 12.2563C1.0807 12.6177 1.03679 12.9605 1.01502 13.2754C0.993613 13.5833 0.982788 13.9037 0.982788 14.2275C0.982788 15.0691 1.25033 15.7505 1.77792 16.253C2.29899 16.7488 2.98834 17.0003 3.8269 17.0003H11.5903C12.4286 17.0003 13.118 16.7488 13.6392 16.253C14.1669 15.7509 14.4344 15.0693 14.4344 14.2274C14.4343 13.9025 14.4233 13.5821 14.4018 13.275ZM12.9877 15.5684C12.6434 15.8961 12.1863 16.0554 11.5902 16.0554H3.8269C3.23067 16.0554 2.77357 15.8961 2.42939 15.5686C2.09172 15.2471 1.92763 14.8084 1.92763 14.2275C1.92763 13.9254 1.93759 13.6271 1.95752 13.3407C1.97695 13.0598 2.01669 12.7511 2.07561 12.4232C2.13379 12.0993 2.20784 11.7954 2.29592 11.5202C2.38043 11.2563 2.49569 10.995 2.63863 10.7434C2.77504 10.5035 2.932 10.2977 3.1052 10.1319C3.26721 9.97677 3.4714 9.84983 3.71201 9.75462C3.93454 9.66654 4.18461 9.61832 4.4561 9.61106C4.48919 9.62865 4.54811 9.66223 4.64356 9.72448C4.8378 9.85106 5.06168 9.99547 5.30917 10.1535C5.58816 10.3314 5.94759 10.4921 6.37702 10.6307C6.81604 10.7726 7.2638 10.8447 7.70824 10.8447C8.15267 10.8447 8.60055 10.7726 9.03933 10.6308C9.46912 10.4919 9.82843 10.3314 10.1078 10.1533C10.3611 9.99141 10.5787 9.85118 10.7729 9.72448C10.8684 9.66236 10.9273 9.62865 10.9604 9.61106C11.232 9.61832 11.4821 9.66654 11.7047 9.75462C11.9452 9.84983 12.1494 9.9769 12.3114 10.1319C12.4846 10.2976 12.6416 10.5034 12.778 10.7435C12.921 10.995 13.0364 11.2564 13.1208 11.5201C13.209 11.7956 13.2832 12.0994 13.3412 12.4231C13.4 12.7516 13.4399 13.0604 13.4593 13.3408C13.4794 13.6261 13.4895 13.9245 13.4896 14.2275C13.4895 14.8085 13.3254 15.2471 12.9877 15.5684Z"/>
                                                        </svg>
                                                        <a href="javascript:;">{{ $single_blog->admin->name }}</a>
                                                    </li>
                                                </ul>
                                                <h3 class="homec-blog__title"><a href="{{ route('blog', $single_blog->slug) }}">{{ $single_blog->title }}</a></h3>
                                                <div class="home-blog__button homec-border-top">
                                                    <a href="{{ route('blog', $single_blog->slug) }}" class="homec-blog__btn">{{__('user.Read More')}}
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 8L16 12M16 12L12 16M16 12H2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9 18.2454C10.3696 19.3433 12.1081 20 14 20C18.4183 20 22 16.4183 22 12C22 7.58172 18.4183 4 14 4C12.1081 4 10.3696 4.65672 9 5.75462" stroke-width="1.5" stroke-linecap="round"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Blog -->
                                </div>
                            @endforeach
                        </div>

                        <div class="row mg-top-40">
                            {{ $blogs->links('custom_pagination') }}
                        </div>

                    @else
                    <div class="row text-danger text-center mg-top-40">
                        <div class="col-12">
                            <h3>{{__('user.Blog Not Found')}}</h3>
                        </div>
                    </div>
                    @endif

				</div>
			</div>
		</section>
		<!-- End Blog Area -->

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
