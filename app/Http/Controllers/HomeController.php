<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\City;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Counter;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\AboutUs;
use App\Models\FooterSocialLink;
use App\Models\BreadcrumbImage;
use App\Models\ContactPage;
use App\Models\GoogleRecaptcha;
use App\Models\ContactMessage;
use App\Models\EmailTemplate;
use App\Models\CustomPagination;
use App\Models\PopularPost;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Faq;
use App\Models\TermsAndCondition;
use App\Models\CustomPage;
use App\Models\Partner;

use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use App\Models\PricingPlan;
use App\Models\PropertyPlan;

use App\Models\Subscriber;
use App\Models\SeoSetting;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\Homepage;
use App\Models\Property;
use App\Models\WhyChooseUs;
use App\Models\PropertySlider;
use App\Models\PropertyAminity;
use App\Models\PropertyNearestLocation;
use App\Models\AdditionalInformation;
use App\Models\Admin;

use App\Rules\Captcha;
use App\Mail\ContactMessageInformation;
use App\Mail\SubscriptionVerification;
use App\Mail\UserRegistration;
use App\Helpers\MailHelper;
use App\Models\Cat;
use App\Models\Section;
use App\Models\Sub;
use Mail;
use Session;
use Str;
use Auth;
use Hash;
use Image;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $setting = Setting::select('selected_theme')->first();
        if ($setting->selected_theme == 0) {
            if ($request->has('theme')) {
                $theme = $request->theme;
                if ($theme == 1) {
                    Session::put('selected_theme', 'theme_one');
                } elseif ($theme == 2) {
                    Session::put('selected_theme', 'theme_two');
                } elseif ($theme == 3) {
                    Session::put('selected_theme', 'theme_three');
                } else {
                    if (!Session::has('selected_theme')) {
                        Session::put('selected_theme', 'theme_three');
                    }
                }
            } else {
                Session::put('selected_theme', 'theme_three');
            }
        } else {
            if ($setting->selected_theme == 1) {
                Session::put('selected_theme', 'theme_one');
            } elseif ($setting->selected_theme == 2) {
                Session::put('selected_theme', 'theme_two');
            } elseif ($setting->selected_theme == 3) {
                Session::put('selected_theme', 'theme_three');
            }
        }


        // basic info
        $homepage = Homepage::first();
        $homepage_filter_location = City::select('id', 'name', 'slug')->get();
        $setting = Setting::first();
        $seo_setting = SeoSetting::where('id', 1)->first();
        // basic info

        // intro section start
        $intro_visibility = true;
        $slider = Slider::first();

        $slider_properties = Property::select('id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'show_slider', 'serial')
            ->where('status', 'enable')
            ->where('show_slider', 'enable')
            ->where('approve_by_admin', 'approved')
            ->where(function ($query) {
                $query->where('expired_date', null)
                    ->orWhere('expired_date', '>=', date('Y-m-d'));
            })
            ->orderBy('serial', 'asc')
            ->get();

        $home1_intro = (object) array(
            'bg_image' => $slider->home1_bg,
            'title_1' => $slider->home1_title_1,
            'title_2' => $slider->home1_title_2,
            'title_3' => $slider->home1_title_3,
            'list1' => $slider->home1_item1,
            'list2' => $slider->home1_item2,
            'list3' => $slider->home1_item3,
            'slider_properties' => $slider_properties,
        );

        $property_types = Category::select('id', 'name', 'slug')->orderBy('name', 'asc')->where('status', 1)->get();

        $home2_intro = (object) array(
            'bg_image' => $slider->home2_bg,
            'title' => $slider->home2_title,
            'property_types' => $property_types,
            'locations' => $homepage_filter_location,
        );

        $home3_intro = (object) array(
            'title' => $slider->home3_title,
            'image' => $slider->home3_image,
            'list1' => $slider->home3_item1,
            'list2' => $slider->home3_item2,
            'list3' => $slider->home3_item3,
            'btn_text' => $slider->home3_btn_text,
            'property_types' => $property_types,
            'locations' => $homepage_filter_location,
        );

        $intro_content = (object) array(
            'visibility' => $intro_visibility,
            'home1_intro' => $home1_intro,
            'home2_intro' => $home2_intro,
            'home3_intro' => $home3_intro,
        );
        // intro section end

        //location section
        $location_visibility = false;
        if ($homepage->show_location == 'enable') $location_visibility = true;
        $location_title = $homepage->location_title;
        $location_description = $homepage->location_description;
        $locations = City::where('show_homepage', 1)->orderBy('serial', 'asc')->get();

        $location = (object) array(
            'visibility' => $location_visibility,
            'title' => $location_title,
            'description' => $location_description,
            'location_for_filter' => $homepage_filter_location,
            'locations' => $locations,
        );
        //location section

        // about us section
        $about_us = AboutUs::first();

        $home1_content = (object) array(
            'experience_text_1' => $about_us->experience_text_1,
            'experience_text_2' => $about_us->experience_text_2,
            'background_image' => $about_us->background_image,
            'author_image' => $about_us->author_image,
            'author_name' => $about_us->author_name,
            'author_designation' => $about_us->author_designation,
            'short_title' => $about_us->short_title,
            'long_title' => $about_us->long_title,
            'description_1' => $about_us->description_1,
            'description_2' => $about_us->description_2,
            'item1' => (object) array(
                'icon' => $about_us->item1_icon,
                'title' => $about_us->item1_title,
                'title2' => $about_us->item1_title2,
                'description' => $about_us->item1_description,
            ),
            'item2' => (object) array(
                'icon' => $about_us->item2_icon,
                'title' => $about_us->item2_title,
                'title2' => $about_us->item2_title2,
                'description' => $about_us->item2_description,
            )
        );

        $home2_content = (object) array(
            'image1' => $about_us->home2_image1,
            'image2' => $about_us->home2_image2,
            'percentage' => $about_us->home2_percentage,
            'percentage_text' => $about_us->home2_percentage_text,
            'short_title' => $about_us->home2_short_title,
            'long_title' => $about_us->home2_long_title,
            'description1' => $about_us->home2_description1,
            'description2' => $about_us->home2_description2,
            'item1' => $about_us->home2_item1,
            'item2' => $about_us->home2_item2,
        );

        $about_us_visibility = false;
        if ($homepage->show_about_us == 'enable') $about_us_visibility = true;

        $about_us = (object) array(
            'visibility' => $about_us_visibility,
            'home1_content' => $home1_content,
            'home2_content' => $home2_content,
            'home3_content' => $home1_content,
        );
        // about us section

        // property section
        $property_visibility = false;
        if ($homepage->show_property == 'enable') $property_visibility = true;
        $property_title = $homepage->property_title;
        $property_description = $homepage->property_description;
        $property_item = $homepage->property_item;

        $featured_properties = Property::with('agent')
            ->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured')
            ->where('status', 'enable')
            ->where('is_featured', 'enable')
            ->where(function ($query) {
                $query->where('expired_date', null)
                    ->orWhere('expired_date', '>=', date('Y-m-d'));
            })
            ->orderBy('id', 'desc')
            ->where('approve_by_admin', 'approved')
            ->take($property_item)
            ->get();
        $top_properties = Property::with('agent')
            ->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured')
            ->where('status', 'enable')
            ->where('is_top', 'enable')
            ->where(function ($query) {
                $query->where('expired_date', null)
                    ->orWhere('expired_date', '>=', date('Y-m-d'));
            })
            ->orderBy('id', 'desc')
            ->where('approve_by_admin', 'approved')
            ->take($property_item)
            ->get();

        $featured_property = (object) array(
            'visibility' => $property_visibility,
            'title' => $property_title,
            'description' => $property_description,
            'properties' => $featured_properties,
        );
        $top_property = (object) array(
            'visibility' => $property_visibility,
            'title' => $property_title,
            'description' => $property_description,
            'properties' => $top_properties,
        );
        // property section

        // why choose us
        $why_choose_visibility = false;
        if ($homepage->show_why_choose_us == 'enable') $why_choose_visibility = true;
        $why_choose_title = $homepage->why_choose_title;
        $why_choose_description = $homepage->why_choose_description;
        $why_choose_us = WhyChooseUs::all();

        $why_choose_us = (object) array(
            'visibility' => $why_choose_visibility,
            'title' => $why_choose_title,
            'description' => $why_choose_description,
            'items' => $why_choose_us,
        );
        // why choose us

        // agent section
        $agent_visibility = false;
        if ($homepage->show_agent == 'enable') $agent_visibility = true;
        $agent_title = $homepage->agent_title;
        $agent_description = $homepage->agent_description;
        $agent_item = $homepage->agent_item;
        $home2_agent_bg = $homepage->home2_agent_bg;

        $agent_order = Order::groupBy('agent_id')->select('agent_id')->get();
        $agent_arr = array();

        foreach ($agent_order as $agent) {
            $agent_arr[] = $agent->agent_id;
        }

        $agents = User::select('id', 'name', 'user_name', 'email', 'status', 'image', 'designation', 'facebook', 'twitter', 'linkedin', 'instagram')->whereIn('id', $agent_arr)->where('status', 1)->orderBy('id', 'desc')->get()->take($agent_item);

        $agent = (object) array(
            'visibility' => $agent_visibility,
            'title' => $agent_title,
            'description' => $agent_description,
            'home2_agent_bg' => $home2_agent_bg,
            'agents' => $agents,
        );
        // agent section

        // faq section
        $faqs = Faq::orderBy('id', 'desc')->get()->take(4);

        $content = (object) array(
            'short_title' => $setting->faq_short_title,
            'long_title' => $setting->faq_long_title,
            'support_image' => $setting->faq_image,
            'support_time' => $setting->faq_support_time,
            'support_title' => $setting->faq_support_title,
        );

        $faq_visibility = false;
        if ($homepage->show_faq == 'enable') $faq_visibility = true;
        $faq = (object) array(
            'visibility' => $faq_visibility,
            'content' => $content,
            'faqs' => $faqs,
        );
        // faq section

        // mobile app
        $app_visibility = false;
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        // blog section
        $blog_visibility = false;
        if ($homepage->show_blog == 'enable') $blog_visibility = true;
        $blog_title = $homepage->blog_title;
        $blog_description = $homepage->blog_description;
        $blog_item = $homepage->blog_item;

        $blogs = Blog::with('admin')->select('id', 'admin_id', 'title', 'slug', 'image', 'status', 'show_homepage', 'created_at')->where('show_homepage', 1)->where('status', 1)->get()->take($blog_item);

        $blog = (object) array(
            'visibility' => $blog_visibility,
            'title' => $blog_title,
            'description' => $blog_description,
            'blogs' => $blogs,
        );
        // blog section

        // category section
        $category_visibility = false;
        if ($homepage->show_category == 'enable') $category_visibility = true;
        $category_item = $homepage->category_item;
        $property_types = Category::select('id', 'name', 'slug', 'icon', 'status')->orderBy('name', 'asc')->where('status', 1)->get()->take($category_item);
        $category = (object) array(
            'visibility' => $category_visibility,
            'property_types' => $property_types,
        );
        // category section

        // counter section
        $counters = Counter::select('id', 'title', 'icon', 'number')->get()->take(4);
        $fun_content = Counter::find(5);
        $counter_visibility = false;
        if ($homepage->show_counter == 'enable') $counter_visibility = true;

        $counter = (object) array(
            'visibility' => $counter_visibility,
            'content' => (object) array(
                'title' => $fun_content->fun_title,
                'description' => $fun_content->fun_description,
                'bg_image' => $fun_content->fun_bg,
                'list_1' => $fun_content->item_1,
                'list_2' => $fun_content->item_2,
                'list_3' => $fun_content->item_3,
            ),
            'items' => $counters,
        );
        // counter section

        // testimonial section
        $testimonial_visibility = false;
        if ($homepage->show_blog == 'enable') $testimonial_visibility = true;
        $testimonial_title = $homepage->testimonial_title;
        $testimonial_description = $homepage->testimonial_description;
        $testimonial_item = $homepage->testimonial_item;

        $testimonials = Testimonial::where('status', 1)->get()->take($testimonial_item);

        $testimonial = (object) array(
            'visibility' => $testimonial_visibility,
            'title' => $testimonial_title,
            'description' => $testimonial_description,
            'bg_image' => $homepage->testimonial_bg,
            'testimonials' => $testimonials,
        );
        // testimonial section

        // partner section
        $partner_visibility = false;
        if ($homepage->show_partner == 'enable') $partner_visibility = true;
        $partner_title = $homepage->partner_title;
        $partner_item = $homepage->partner_item;

        $partners = Partner::where('status', 1)->get()->take($partner_item);

        $partner = (object) array(
            'visibility' => $partner_visibility,
            'title' => $partner_title,
            'partners' => $partners,
        );
        // partner section

        // urgent property
        $urgent_property_visibility = false;
        if ($homepage->show_urgent_property == 'enable') $urgent_property_visibility = true;
        $property_title = $homepage->urgent_property_title;
        $property_description = $homepage->urgent_property_description;
        $property_item = $homepage->urgent_property_item;
        $urgent_properties = Property::with('agent')
            ->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured', 'is_urgent', 'video_id')
            ->where('status', 'enable')
            ->where('is_urgent', 'enable')
            ->where(function ($query) {
                $query->where('expired_date', null)
                    ->orWhere('expired_date', '>=', date('Y-m-d'));
            })
            ->orderBy('id', 'desc')
            ->where('approve_by_admin', 'approved')
            ->take($property_item)
            ->get();

        $urgent_property = (object) array(
            'visibility' => $urgent_property_visibility,
            'title' => $property_title,
            'description' => $property_description,
            'properties' => $urgent_properties,
        );
        // urgent property

        // pricing plan
        $pricing_plan_visibility = false;
        if ($homepage->show_pricing_plan == 'enable') $pricing_plan_visibility = true;
        $pricing_plan_title = $homepage->pricing_plan_title;
        $pricing_plan_description = $homepage->pricing_plan_description;

        $pricing_plans = PricingPlan::where('status', 'enable')->orderBy('serial', 'asc')->get();

        $pricing_plan = (object) array(
            'visibility' => $pricing_plan_visibility,
            'title' => $pricing_plan_title,
            'description' => $pricing_plan_description,
            'pricing_plans' => $pricing_plans,
        );

        $minimum_price = Property::selectRaw('MIN(CAST(price AS UNSIGNED)) as price')->value('price');
        $max_price = Property::selectRaw('MAX(CAST(price AS UNSIGNED)) as price')->value('price');

        $price_range = $max_price - $minimum_price;
        $mod_price = $price_range / 10;

        $min_price = 0;
        $filter_prices = array();
        for ($i = 1; $i <= 10; $i++) {
            $max_price = $minimum_price + ($mod_price * $i);

            $prices = (object) array(
                'min' => $min_price,
                'max' => $max_price,
            );

            $filter_prices[] = $prices;

            $min_price = $max_price + 1;
        }

        $businessReklame = Section::where("vip", "1")->get();

        $selected_theme = Session::get('selected_theme');

        if ($selected_theme == 'theme_one') {
            return view('index')->with([
                'cats' => Cat::all(),
                'selected_theme' => $selected_theme,
                'seo_setting' => $seo_setting,
                'intro_content' => $intro_content,
                'location' => $location,
                'category' => $category,
                'about_us' => $about_us,
                'featured_property' => $featured_property,
                'top_property' => $top_property,
                'why_choose_us' => $why_choose_us,
                'agent' => $agent,
                'faq' => $faq,
                'mobile_app' => $mobile_app,
                'counter' => $counter,
                'testimonial' => $testimonial,
                'blog' => $blog,
                'pricing_plan' => $pricing_plan,
                'filter_prices' => $pricing_plan,
            ]);
        } elseif ($selected_theme == 'theme_two') {
            return view('index2')->with([
                'cats' => Cat::all(),

                'selected_theme' => $selected_theme,
                'seo_setting' => $seo_setting,
                'intro_content' => $intro_content,
                'location' => $location,
                'category' => $category,
                'about_us' => $about_us,
                'featured_property' => $featured_property,
                'urgent_property' => $urgent_property,
                'why_choose_us' => $why_choose_us,
                'agent' => $agent,
                'faq' => $faq,
                'mobile_app' => $mobile_app,
                'counter' => $counter,
                'partner' => $partner,
                'testimonial' => $testimonial,
                'blog' => $blog,
                'pricing_plan' => $pricing_plan,
                'filter_prices' => $filter_prices,
            ]);
        } elseif ($selected_theme == 'theme_three') {
            return view('index3')->with([
                'cats' => Cat::where('status', "1")->get(),
                'subs' => Sub::where('status', "1")->get(),
                'top_property' => $top_property,
                'businessReklames' => $businessReklame,

                'selected_theme' => $selected_theme,
                'seo_setting' => $seo_setting,
                'intro_content' => $intro_content,
                'location' => $location,
                'category' => $category,
                'about_us' => $about_us,
                'featured_property' => $featured_property,
                'urgent_property' => $urgent_property,
                'why_choose_us' => $why_choose_us,
                'agent' => $agent,
                'faq' => $faq,
                'mobile_app' => $mobile_app,
                'counter' => $counter,
                'testimonial' => $testimonial,
                'blog' => $blog,
                'partner' => $partner,
                'pricing_plan' => $pricing_plan,
                'filter_prices' => $filter_prices,
            ]);
        } else {
            return view('index')->with([
                'selected_theme' => $selected_theme,
                'seo_setting' => $seo_setting,
                'intro_content' => $intro_content,
                'location' => $location,
                'category' => $category,
                'about_us' => $about_us,
                'featured_property' => $featured_property,
                'urgent_property' => $urgent_property,
                'why_choose_us' => $why_choose_us,
                'agent' => $agent,
                'faq' => $faq,
                'mobile_app' => $mobile_app,
                'counter' => $counter,
                'testimonial' => $testimonial,
                'blog' => $blog,
                'pricing_plan' => $pricing_plan,
                'filter_prices' => $filter_prices,
            ]);
        }
    }


    public function about_us()
    {
        $seo_setting = SeoSetting::where('id', 2)->first();
        $homepage = Homepage::first();
        $setting = Setting::first();

        // about us section
        $about_us = AboutUs::first();
        $about_us = (object) array(
            'experience_text_1' => $about_us->experience_text_1,
            'experience_text_2' => $about_us->experience_text_2,
            'background_image' => $about_us->background_image,
            'author_image' => $about_us->author_image,
            'author_name' => $about_us->author_name,
            'author_designation' => $about_us->author_designation,
            'short_title' => $about_us->short_title,
            'long_title' => $about_us->long_title,
            'description_1' => $about_us->description_1,
            'description_2' => $about_us->description_2,
            'item1' => (object) array(
                'icon' => $about_us->item1_icon,
                'title' => $about_us->item1_title,
                'title2' => $about_us->item1_title2,
                'description' => $about_us->item1_description,
            ),
            'item2' => (object) array(
                'icon' => $about_us->item2_icon,
                'title' => $about_us->item2_title,
                'title2' => $about_us->item2_title2,
                'description' => $about_us->item2_description,
            )
        );
        // about us section

        // category section
        $category_visibility = false;
        if ($homepage->show_category == 'enable') $category_visibility = true;
        $category_item = $homepage->category_item;
        $property_types = Category::select('id', 'name', 'slug', 'icon', 'status')->orderBy('name', 'asc')->where('status', 1)->get()->take($category_item);
        $category = (object) array(
            'visibility' => $category_visibility,
            'property_types' => $property_types,
        );
        // category section

        // counter section
        $counters = Counter::select('id', 'title', 'icon', 'number')->get()->take(4);
        $fun_content = Counter::find(5);
        $counter_visibility = false;
        if ($homepage->show_counter == 'enable') $counter_visibility = true;

        $counter = (object) array(
            'visibility' => $counter_visibility,
            'content' => (object) array(
                'title' => $fun_content->fun_title,
                'description' => $fun_content->fun_description,
                'bg_image' => $fun_content->fun_bg,
                'list_1' => $fun_content->item_1,
                'list_2' => $fun_content->item_2,
                'list_3' => $fun_content->item_3,
            ),
            'items' => $counters,
        );
        // counter section

        // agent section
        $agent_visibility = false;
        if ($homepage->show_agent == 'enable') $agent_visibility = true;
        $agent_title = $homepage->agent_title;
        $agent_description = $homepage->agent_description;
        $agent_item = $homepage->agent_item;
        $home2_agent_bg = $homepage->home2_agent_bg;

        $agent_order = Order::groupBy('agent_id')->select('agent_id')->get();
        $agent_arr = array();

        foreach ($agent_order as $agent) {
            $agent_arr[] = $agent->agent_id;
        }

        $agents = User::select('id', 'name', 'user_name', 'email', 'status', 'image', 'designation', 'facebook', 'twitter', 'linkedin', 'instagram')->whereIn('id', $agent_arr)->where('status', 1)->orderBy('id', 'desc')->get()->take($agent_item);

        $agent = (object) array(
            'visibility' => $agent_visibility,
            'title' => $agent_title,
            'description' => $agent_description,
            'home2_agent_bg' => $home2_agent_bg,
            'agents' => $agents,
        );
        // agent section

        // faq section
        $faqs = Faq::orderBy('id', 'desc')->get()->take(4);

        $content = (object) array(
            'short_title' => $setting->faq_short_title,
            'long_title' => $setting->faq_long_title,
            'support_image' => $setting->faq_image,
            'support_time' => $setting->faq_support_time,
            'support_title' => $setting->faq_support_title,
        );

        $faq_visibility = false;
        if ($homepage->show_faq == 'enable') $faq_visibility = true;
        $faq = (object) array(
            'visibility' => $faq_visibility,
            'content' => $content,
            'faqs' => $faqs,
        );
        // faq section

        // mobile app
        $app_visibility = false;
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        return view('about_us')->with([
            'seo_setting' => $seo_setting,
            'about_us' => $about_us,
            'category' => $category,
            'counter' => $counter,
            'agent' => $agent,
            'faq' => $faq,
            'mobile_app' => $mobile_app,
        ]);
    }

    public function contact_us()
    {
        $setting = Setting::first();
        $contact = ContactPage::first();
        $recaptcha_setting = GoogleRecaptcha::first();

        $seo_setting = SeoSetting::where('id', 3)->first();

        // mobile app
        $app_visibility = false;
        $homepage = Homepage::first();
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        return view('contact_us')->with([
            'seo_setting' => $seo_setting,
            'contact' => $contact,
            'recaptcha_setting' => $recaptcha_setting,
            'mobile_app' => $mobile_app,
        ]);
    }

    public function send_contact_message(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => new Captcha()
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required'),
        ];
        $this->validate($request, $rules, $customMessages);


        $setting = Setting::first();
        if ($setting->enable_save_contact_message == 1) {
            $contact = new ContactMessage();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();
        }

        MailHelper::setMailConfig();
        $template = EmailTemplate::where('id', 2)->first();
        $message = $template->description;
        $subject = $template->subject;
        $message = str_replace('{{name}}', $request->name, $message);
        $message = str_replace('{{email}}', $request->email, $message);
        $message = str_replace('{{phone}}', $request->phone, $message);
        $message = str_replace('{{subject}}', $request->subject, $message);
        $message = str_replace('{{message}}', $request->message, $message);

        Mail::to($setting->contact_email)->send(new ContactMessageInformation($message, $subject));

        $notification = trans('user_validation.Message send successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    public function blogs(Request $request)
    {
        $seo_setting = SeoSetting::where('id', 6)->first();

        $paginate_qty = CustomPagination::whereId('1')->first()->qty;

        $blogs = Blog::with('admin')->select('id', 'title', 'image', 'slug', 'status', 'created_at', 'admin_id')->where(['status' => 1])->orderBy('id', 'desc');

        if ($request->search) {
            $blogs = $blogs->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->category) {
            $category = BlogCategory::where('slug', $request->category)->first();
            $blogs = $blogs->where('blog_category_id', $category->id);
        }
        $blogs = $blogs->paginate($paginate_qty);

        // mobile app
        $app_visibility = false;
        $homepage = Homepage::first();
        $setting = Setting::first();
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        return view('blog')->with([
            'seo_setting' => $seo_setting,
            'blogs' => $blogs,
            'mobile_app' => $mobile_app,
        ]);
    }


    public function single_blog($slug)
    {

        $blog = Blog::with('category', 'admin')->where('slug', $slug)->first();

        $blog_tag_array = array();
        if ($blog->tags) {
            $blog_tag_array = explode(",", $blog->tags);
        }

        $blog_pagiante_qty = CustomPagination::whereId('4')->first()->qty;
        $blog_comments = BlogComment::where(['blog_id' => $blog->id, 'status' => 1])->paginate($blog_pagiante_qty);

        $recaptcha_setting = GoogleRecaptcha::first();

        $popularBlogs = PopularPost::select('id', 'blog_id')->get();
        $popular_arr = array();
        foreach ($popularBlogs as $popularBlog) {
            $popular_arr[] = $popularBlog->blog_id;
        }
        $popular_blogs = Blog::select('id', 'title', 'image', 'slug', 'status', 'created_at')->where(['status' => 1])->orderBy('id', 'desc')->whereIn('id', $popular_arr)->where('id', '!=', $blog->id)->get()->take(6);

        $categories = BlogCategory::where(['status' => 1])->orderBy('name', 'asc')->get();

        $social_links = FooterSocialLink::all();

        // mobile app
        $app_visibility = false;
        $homepage = Homepage::first();
        $setting = Setting::first();
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        return view('show_blog')->with([
            'blog' => $blog,
            'blog_tag_array' => $blog_tag_array,
            'blog_comments' => $blog_comments,
            'recaptcha_setting' => $recaptcha_setting,
            'popular_blogs' => $popular_blogs,
            'categories' => $categories,
            'social_links' => $social_links,
            'mobile_app' => $mobile_app,
        ]);
    }

    public function blog_comment(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
            'blog_id' => 'required',
            'g-recaptcha-response' => new Captcha()
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'comment.required' => trans('user_validation.Comment is required'),
            'blog_id.required' => trans('user_validation.Blog id is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $comment = new BlogComment();
        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = trans('user_validation.Blog comment submited successfully');

        return response()->json(['status' => 1, 'message' => $notification]);
    }

    public function faq()
    {

        $homepage = Homepage::first();
        $setting = Setting::first();

        // faq section
        $faqs = Faq::orderBy('id', 'desc')->get()->take(6);

        $content = (object) array(
            'short_title' => $setting->faq_short_title,
            'long_title' => $setting->faq_long_title,
            'support_image' => $setting->faq_image,
            'support_time' => $setting->faq_support_time,
            'support_title' => $setting->faq_support_title,
        );

        $faq_visibility = false;
        if ($homepage->show_faq == 'enable') $faq_visibility = true;
        $faq = (object) array(
            'content' => $content,
            'faqs' => $faqs,
        );
        // faq section

        // category section
        $category_visibility = false;
        if ($homepage->show_category == 'enable') $category_visibility = true;
        $category_item = $homepage->category_item;
        $property_types = Category::select('id', 'name', 'slug', 'icon', 'status')->orderBy('name', 'asc')->where('status', 1)->get()->take(4);
        $category = (object) array(
            'visibility' => $category_visibility,
            'property_types' => $property_types,
        );
        // category section

        // counter section
        $counters = Counter::select('id', 'title', 'icon', 'number')->get()->take(4);
        $fun_content = Counter::find(5);
        $counter_visibility = false;
        if ($homepage->show_counter == 'enable') $counter_visibility = true;

        $counter = (object) array(
            'visibility' => $counter_visibility,
            'content' => (object) array(
                'title' => $fun_content->fun_title,
                'description' => $fun_content->fun_description,
                'bg_image' => $fun_content->fun_bg,
                'list_1' => $fun_content->item_1,
                'list_2' => $fun_content->item_2,
                'list_3' => $fun_content->item_3,
            ),
            'items' => $counters,
        );
        // counter section

        // mobile app
        $app_visibility = false;
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        return view('faq')->with([
            'faq' => $faq,
            'category' => $category,
            'counter' => $counter,
            'mobile_app' => $mobile_app,
        ]);
    }

    public function terms_and_condition()
    {
        $terms_conditions = TermsAndCondition::first();
        $terms_conditions = $terms_conditions->terms_and_condition;

        return view('terms_and_conditions')->with([
            'terms_conditions' => $terms_conditions,
        ]);
    }

    public function privacy_policy()
    {

        $privacyPolicy = TermsAndCondition::first();
        $privacyPolicy = $privacyPolicy->privacy_policy;

        return view('privacy_policy')->with([
            'privacyPolicy' => $privacyPolicy,
        ]);
    }


    public function custom_page($slug)
    {

        $page = CustomPage::where(['slug' => $slug, 'status' => 1])->first();

        return view('custom_page')->with([
            'page' => $page
        ]);
    }

    public function pricing_plan()
    {
        $pricing_plans = PricingPlan::where('status', 'enable')->orderBy('serial', 'asc')->get();

        $homepage = Homepage::first();
        $setting = Setting::first();

        // faq section
        $faqs = Faq::orderBy('id', 'desc')->get()->take(5);

        $content = (object) array(
            'short_title' => $setting->faq_short_title,
            'long_title' => $setting->faq_long_title,
            'support_image' => $setting->faq_image,
            'support_time' => $setting->faq_support_time,
            'support_title' => $setting->faq_support_title,
        );

        $faq_visibility = false;
        if ($homepage->show_faq == 'enable') $faq_visibility = true;
        $faq = (object) array(
            'content' => $content,
            'faqs' => $faqs,
        );
        // faq section

        // mobile app
        $app_visibility = false;
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app


        return view('pricing_plan')->with([
            'pricing_plans' => $pricing_plans,
            'faq' => $faq,
            'mobile_app' => $mobile_app,
        ]);
    }

    public function properties(Request $request)
    {

        $seo_setting = SeoSetting::where('id', 5)->first();

        $paginate_qty = CustomPagination::find(2);

        $properties = Property::with('agent')
            ->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured', 'city_id', 'property_type_id')
            ->where('status', 'enable')
            ->where('approve_by_admin', 'approved')
            ->where(function ($query) {
                $query->where('expired_date', null)
                    ->orWhere('expired_date', '>=', date('Y-m-d'));
            })
            ->latest('id');


        if ($request->purpose) {
            if ($request->purpose == 'rent') {
                $properties = $properties->where('purpose', 'rent');
            }

            if ($request->purpose == 'sale') {
                $properties = $properties->where('purpose', 'sale');
            }
        }

        if ($request->location) {
            $location = City::where('slug', $request->location)->first();
            $properties = $properties->where('city_id', $location->id);
        }

        if ($request->type) {
            $category = Category::where('slug', $request->type)->first();
            $properties = $properties->where('property_type_id', $category->id);
        }

        if ($request->min_price) {
            $properties = $properties->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $properties = $properties->where('price', '<=', $request->max_price);
        }

        if ($request->min_area) {
            $properties = $properties->whereRaw('CAST(total_area AS DECIMAL) >= ?', [$request->min_area]);
        }

        if ($request->max_area) {
            $properties = $properties->whereRaw('CAST(total_area AS DECIMAL) <= ?', [$request->max_area]);
        }

        if ($request->urgent_property) {
            $properties = $properties->where('is_urgent', 'enable');
        }

        if ($request->featured_property) {
            $properties = $properties->where('is_featured', 'enable');
        }

        if ($request->top_property) {
            $properties = $properties->where('is_top', 'enable');
        }

        $rooms = $request->input('rooms', []);

        if (!empty($rooms)) {
            $properties = $properties->whereIn('total_bedroom', $rooms);
        }

        $bath_rooms = $request->input('bath_rooms', []);

        if (!empty($bath_rooms)) {
            $properties = $properties->whereIn('total_bathroom', $bath_rooms);
        }

        if ($request->search) {
            $properties = $properties->where('title', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $properties = $properties->paginate($paginate_qty->qty);

        $locations = City::select('id', 'name', 'slug')->get();
        $property_types = Category::select('id', 'name', 'slug')->orderBy('name', 'asc')->where('status', 1)->get();

        // agent section
        $agent_order = Order::groupBy('agent_id')->select('agent_id')->get();
        $agent_arr = array();

        foreach ($agent_order as $agent) {
            $agent_arr[] = $agent->agent_id;
        }

        $agents = User::select('id', 'name', 'user_name', 'email', 'status', 'image', 'designation', 'facebook', 'twitter', 'linkedin', 'instagram')->whereIn('id', $agent_arr)->where('status', 1)->orderBy('id', 'desc')->get()->take(6);

        // agent section

        $max_bed_room = Property::selectRaw('MAX(CAST(total_bedroom AS UNSIGNED)) as max_room')->value('max_room');
        $max_bath_room = Property::selectRaw('MAX(CAST(total_bathroom AS UNSIGNED)) as total_bathroom')->value('total_bathroom');
        $max_area = Property::selectRaw('MAX(CAST(total_area AS UNSIGNED)) as total_area')->value('total_area');
        $max_price = Property::selectRaw('MAX(CAST(price AS UNSIGNED)) as price')->value('price');

        return view('properties')->with([
            'seo_setting' => $seo_setting,
            'locations' => $locations,
            'property_types' => $property_types,
            'slider_agents' => $agents,
            'properties' => $properties,
            'max_bed_room' => $max_bed_room,
            'max_bath_room' => $max_bath_room,
            'max_area' => $max_area,
            'max_price' => $max_price,
        ]);
    }

    public function properties_with_ajax(Request $request)
    {

        $paginate_qty = CustomPagination::find(2);

        $properties = Property::with('agent')
            ->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured', 'city_id', 'property_type_id')
            ->where('status', 'enable')
            ->where('approve_by_admin', 'approved')
            ->where(function ($query) {
                $query->where('expired_date', null)
                    ->orWhere('expired_date', '>=', date('Y-m-d'));
            });


        if ($request->purpose) {
            if ($request->purpose == 'rent') {
                $properties = $properties->where('purpose', 'rent');
            }

            if ($request->purpose == 'sale') {
                $properties = $properties->where('purpose', 'sale');
            }
        }

        if ($request->location) {
            $location = City::where('slug', $request->location)->first();
            $properties = $properties->where('city_id', $location->id);
        }

        if ($request->type) {
            $category = Category::where('slug', $request->type)->first();
            $properties = $properties->where('property_type_id', $category->id);
        }


        if ($request->min_price) {
            $properties = $properties->whereRaw('CAST(price AS DECIMAL) >= ?', [$request->min_price]);
        }

        if ($request->max_price) {
            $properties = $properties->whereRaw('CAST(price AS DECIMAL) <= ?', [$request->max_price]);
        }

        if ($request->min_area) {
            $properties = $properties->whereRaw('CAST(total_area AS DECIMAL) >= ?', [$request->min_area]);
        }

        if ($request->max_area) {
            $properties = $properties->whereRaw('CAST(total_area AS DECIMAL) <= ?', [$request->max_area]);
        }

        if ($request->urgent_property) {
            $properties = $properties->where('is_urgent', 'enable');
        }

        if ($request->featured_property) {
            $properties = $properties->where('is_featured', 'enable');
        }

        if ($request->top_property) {
            $properties = $properties->where('is_top', 'enable');
        }

        $rooms = $request->input('rooms', []);

        if (!empty($rooms)) {
            $properties = $properties->whereIn('total_bedroom', $rooms);
        }

        $bath_rooms = $request->input('bath_rooms', []);

        if (!empty($bath_rooms)) {
            $properties = $properties->whereIn('total_bathroom', $bath_rooms);
        }

        if ($request->search) {
            $properties = $properties->where('title', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        // others

        if ($request->others_sorting) {
            if ($request->others_sorting == 'default_sort') {
                $properties = $properties->orderBy('id', 'desc');
            } elseif ($request->others_sorting == 'price_low_to_high') {
                $properties = $properties->orderByRaw('CAST(price AS DECIMAL) ASC');
            } elseif ($request->others_sorting == 'price_high_to_low') {
                $properties = $properties->orderByRaw('CAST(price AS DECIMAL) DESC');
            } elseif ($request->others_sorting == 'sort_by_newest') {
                $properties = $properties->orderBy('id', 'desc');
            } elseif ($request->others_sorting == 'sort_by_oldest') {
                $properties = $properties->orderBy('id', 'asc');
            } else {
                $properties = $properties->orderBy('id', 'desc');
            }
        } else {
            $properties = $properties->orderBy('id', 'desc');
        }

        $properties = $properties->paginate($paginate_qty->qty);
        $properties = $properties->appends($request->all());

        return view('properties_with_ajax')->with(['properties' => $properties]);
    }

    public function property($slug)
    {

        $property = Property::where('slug', $slug)
            ->where([
                'status' => 'enable',
                'approve_by_admin' => 'approved'
            ])
            ->where(function ($query) {
                $query->where('expired_date', null)
                    ->orWhere('expired_date', '>=', date('Y-m-d'));
            })
            ->first();

        if (!$property) {
            abort(404);
        }

        $sliders = PropertySlider::where('property_id', $property->id)->get();
        $aminities = PropertyAminity::with('aminity')->where('property_id', $property->id)->get();
        $nearest_locations = PropertyNearestLocation::with('location')->where('property_id', $property->id)->get();
        $additional_informations = AdditionalInformation::where('property_id', $property->id)->get();
        $property_plans = PropertyPlan::where('property_id', $property->id)->get();
        $reviews = Review::with('user')->where('property_id', $property->id)->paginate(10);

        if ($property->agent_id == 0) {
            $admin = Admin::find(1);
            $property_agent = (object) array(
                'agent_type'  => 'admin',
                'id' => $admin->id,
                'name' => $admin->agent_name,
                'user_name' => $admin->user_name,
                'designation' => $admin->designation,
                'email' => $admin->agent_email,
                'phone' => $admin->phone,
                'image' => $admin->agent_image,
            );
        } else {
            $agent = User::find($property->agent_id);

            $property_agent = (object) array(
                'agent_type'  => 'agent',
                'id' => $agent->id,
                'name' => $agent->name,
                'user_name' => $agent->user_name,
                'designation' => $agent->designation,
                'email' => $agent->email,
                'phone' => $agent->phone,
                'image' => $agent->image,
            );
        }
        $featured_properties = Property::with('agent')
            ->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured')
            ->where('status', 'enable')
            ->where('is_featured', 'enable')
            ->where(function ($query) {
                $query->where('expired_date', null)
                ->orWhere('expired_date', '>=', date('Y-m-d'));
            })
            ->orderBy('id', 'desc')
            ->where('approve_by_admin', 'approved')
            ->get();

        $recaptcha_setting = GoogleRecaptcha::first();

        return view('property_show')->with([
            'property' => $property,
            'featured_properties' => $featured_properties,
            'sliders' => $sliders,
            'aminities' => $aminities,
            'nearest_locations' => $nearest_locations,
            'additional_informations' => $additional_informations,
            'property_plans' => $property_plans,
            'reviews' => $reviews,
            'property_agent' => $property_agent,
            'recaptcha_setting' => $recaptcha_setting,
        ]);
    }

    public function agents(Request $request)
    {

        $agent_order = Order::groupBy('agent_id')->select('agent_id')->get();
        $agent_arr = array();

        foreach ($agent_order as $agent) {
            $agent_arr[] = $agent->agent_id;
        }

        $paginate_qty = CustomPagination::find(3);

        $agents = User::select('id', 'name', 'user_name', 'email', 'status', 'image', 'designation', 'facebook', 'twitter', 'linkedin', 'instagram')->whereIn('id', $agent_arr)->where('status', 1)->orderBy('id', 'desc')->paginate($paginate_qty->qty);

        $homepage = Homepage::first();
        $setting = Setting::first();

        // faq section
        $faqs = Faq::orderBy('id', 'desc')->get()->take(6);

        $content = (object) array(
            'short_title' => $setting->faq_short_title,
            'long_title' => $setting->faq_long_title,
            'support_image' => $setting->faq_image,
            'support_time' => $setting->faq_support_time,
            'support_title' => $setting->faq_support_title,
        );

        $faq_visibility = false;
        if ($homepage->show_faq == 'enable') $faq_visibility = true;
        $faq = (object) array(
            'visibility' => $faq_visibility,
            'content' => $content,
            'faqs' => $faqs,
        );
        // faq section

        // mobile app
        $app_visibility = false;
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        $seo_setting = SeoSetting::find(7);

        return view('agents')->with([
            'seo_setting' => $seo_setting,
            'agents' => $agents,
            'faq' => $faq,
            'mobile_app' => $mobile_app,
        ]);
    }

    public function agent(Request $request)
    {
        if (!$request->agent_type || !$request->user_name) {
            abort(404);
        }

        $total_property = 0;
        $total_review = 0;

        // return $total_property;
        if ($request->agent_type == 'agent') {
            $agent = User::select('id', 'name', 'user_name', 'email', 'status', 'image', 'designation', 'facebook', 'twitter', 'linkedin', 'instagram', 'about_me', 'phone', 'address')->where('user_name', $request->user_name)->where('status', 1)->first();
            if (!$agent) abort(404);

            $paginate_qty = CustomPagination::find(2);

            $properties = Property::with('agent')
                ->where(function ($query) use ($agent) {
                    $query->where('agent_id', $agent->id)
                        ->where(function ($subquery) {
                            $subquery->where('expired_date', null)
                                ->orWhere('expired_date', '>=', date('Y-m-d'));
                        });
                })
                ->where('status', 'enable')
                ->where('approve_by_admin', 'approved')
                ->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured')
                ->orderBy('id', 'desc');

            if ($request->search) {
                $properties = $properties->where('title', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%');
            }

            $properties = $properties->paginate($paginate_qty->qty);
            $properties = $properties->appends($request->all());


            $total_property = Property::with('agent')
                ->where(function ($query) use ($agent) {
                    $query->where('agent_id', $agent->id)
                        ->where(function ($subquery) {
                            $subquery->where('expired_date', null)
                                ->orWhere('expired_date', '>=', date('Y-m-d'));
                        });
                })
                ->where('status', 'enable')
                ->where('approve_by_admin', 'approved')
                ->count();

            $total_review = Review::where('status', 1)->where('agent_id', $agent->id)->count();
        } elseif ($request->agent_type == 'admin') {
            $agent = Admin::where('user_name', $request->user_name)->where('status', 1)->first();
            if (!$agent) abort(404);
            $agent = (object) array(
                'id' => $agent->id,
                'name' => $agent->agent_name,
                'phone' => $agent->agent_phone,
                'email' => $agent->agent_email,
                'user_name' => $agent->user_name,
                'status' => $agent->status,
                'image' => $agent->agent_image,
                'address' => $agent->agent_address,
                'designation' => $agent->designation,
                'facebook' => $agent->facebook,
                'twitter' => $agent->twitter,
                'linkedin' => $agent->linkedin,
                'instagram' => $agent->instagram,
                'about_me' => $agent->about_me,
            );

            $paginate_qty = CustomPagination::find(2);

            $properties = Property::with('agent')->select('id', 'agent_id', 'title', 'slug', 'purpose', 'rent_period', 'price', 'thumbnail_image', 'address', 'total_bedroom', 'total_bathroom', 'total_area', 'status', 'is_featured')->where('status', 'enable')->where('agent_id', 0)->orderBy('id', 'desc');

            if ($request->search) {
                $properties = $properties->where('title', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%');
            }

            $properties = $properties->paginate($paginate_qty->qty);
            $properties = $properties->appends($request->all());


            $total_property =  Property::with('agent')->where('status', 'enable')->where('agent_id', 0)->count();

            $total_review = Review::where('status', 1)->where('agent_id', 0)->count();
        } else {
            abort(404);
        }

        $homepage = Homepage::first();
        $setting = Setting::first();

        // mobile app
        $app_visibility = false;
        if ($homepage->show_mobile_app == 'enable') $app_visibility = true;
        $mobile_app = (object) array(
            'visibility' => $app_visibility,
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
        // mobile app

        $recaptcha_setting = GoogleRecaptcha::first();

        return view('agent_show')->with([
            'agent' => $agent,
            'properties' => $properties,
            'mobile_app' => $mobile_app,
            'recaptcha_setting' => $recaptcha_setting,
        ]);
    }

    public function store_property_review(Request $request)
    {
        $rules = [
            'agent_id' => 'required',
            'property_id' => 'required',
            'rating' => 'required',
            'review' => 'required',
            'g-recaptcha-response' => new Captcha()
        ];

        $customMessages = [
            'review.required' => trans('user_validation.Review is required'),
        ];
        $this->validate($request, $rules, $customMessages);
        $user = Auth::guard('web')->user();

        $review = new Review();
        $review->user_id = $user->id;
        $review->property_id = $request->property_id;
        $review->agent_id = $request->agent_id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        $notification = trans('user_validation.Review submited successfully');
        return response()->json(['status' => 1, 'message' => $notification]);
    }

    public function subscribe_request(Request $request)
    {
        if ($request->email != null) {
            $isExist = Subscriber::where('email', $request->email)->count();
            if ($isExist == 0) {
                $subscriber = new Subscriber();
                $subscriber->email = $request->email;
                $subscriber->verified_token = Str::random(25);
                $subscriber->save();

                MailHelper::setMailConfig();

                $template = EmailTemplate::where('id', 3)->first();
                $message = $template->description;
                $subject = $template->subject;
                Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber, $message, $subject));

                return response()->json(['status' => 1, 'message' => trans('user_validation.Subscription successfully, please verified your email')]);
            } else {
                return response()->json(['status' => 0, 'message' => trans('user_validation.Email already exist')]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => trans('user_validation.Email Field is required')]);
        }
    }

    public function subscriber_verifcation($token)
    {
        $subscriber = Subscriber::where('verified_token', $token)->first();
        if ($subscriber) {
            $subscriber->verified_token = null;
            $subscriber->is_verified = 1;
            $subscriber->save();
            $notification = trans('user_validation.Email verification successfully');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->route('home')->with($notification);
        } else {
            $notification = trans('user_validation.Invalid token');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('home')->with($notification);
        }
    }

    public function send_mail_to_agent(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'agent_email' => 'required',
            'g-recaptcha-response' => new Captcha()
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required'),
            'agent_email.required' => trans('user_validation.Agent email is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        MailHelper::setMailConfig();
        $template = EmailTemplate::where('id', 12)->first();
        $message = $template->description;
        $subject = $template->subject;
        $message = str_replace('{{name}}', $request->name, $message);
        $message = str_replace('{{email}}', $request->email, $message);
        $message = str_replace('{{subject}}', $request->subject, $message);
        $message = str_replace('{{message}}', $request->message, $message);

        Mail::to($request->agent_email)->send(new ContactMessageInformation($message, $subject));

        $notification = trans('user_validation.Message send successfully');
        return response()->json(['status' => 1, 'message' => $notification]);
    }

    public function downloadListingFile($file)
    {
        $filepath = public_path() . "/uploads/custom-images/" . $file;
        return response()->download($filepath);
    }
}
