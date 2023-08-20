<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Category;
use App\Models\City;
use App\Models\Homepage;
use App\Models\PropertySlider;
use App\Models\Section;
use App\Models\Section_image;
use App\Models\SeoSetting;
use App\Models\Setting;
use App\Models\Sub;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use File;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat_id)
    {
        $seo_setting = SeoSetting::where('id', 5)->first();


        $subs = Sub::where('cat_id', $cat_id)->where('status', 1)->get();
        $cities = City::all();
        $property_types = Category::select('id', 'name', 'slug')->orderBy('name', 'asc')->where('status', 1)->get();


        return view("sections", compact("cat_id", "subs", 'cities', 'seo_setting', "property_types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::select('id', 'name')->get();
        $cats = Cat::select('id', 'name')->where('status', 1)->get();
        $subs = Sub::select('id', 'name')->where('status', 1)->get();

        return view("admin.section_create", compact("cities", 'cats', 'subs'));
    }
    public function userCreate()
    {
        $cities = City::select('id', 'name')->get();
        $cats = Cat::select('id', 'name')->where('status', 1)->get();
        $subs = Sub::select('id', 'name')->where('status', 1)->get();

        return view("user.section_create", compact("cities", 'cats', 'subs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'cat_id' => 'required',
            'sub_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required|max:11',
            'thumbnail_image' => 'required',
            'slider_images' => 'required|array',
            "video_thumbnail" => "",
            "video_id" => "",
            "address" => "",
            "expire_date" => ""
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();


        if ($validatedData['thumbnail_image']) {
            $image = $validatedData['thumbnail_image'];
            $extention = $image->getClientOriginalExtension();
            $image_name = 'Property-slider' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
            $image_name = 'uploads/section-images/' . $image_name;
            Image::make($image)
                ->encode('webp', 80)
                ->save(public_path() . '/' . $image_name);

            $section = new Section();
            $section->name = $validatedData['name'];
            $section->description = $validatedData['description'];
            $section->cat_id = $validatedData['cat_id'];
            $section->sub_id = $validatedData['sub_id'];
            $section->city_id = $validatedData['city_id'];
            $section->image = $image_name;
            $section->phone = $validatedData['phone'];
            $section->address = $validatedData['address'];
            $section->video_id = $validatedData['video_id'];
            $section->user_id = 1;
            if ($validatedData['expire_date']) {
                $section->approved_date = Carbon::today();
                $section->expired_date = $validatedData['expire_date'];
            }

            $section->save();

            foreach ($validatedData["slider_images"] as $image) {

                $extention = $image->getClientOriginalExtension();
                $image_name = 'Property-slider' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/section-images/' . $image_name;
                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);
                $slider = new Section_image();
                $slider->section_id = $section->id;
                $slider->image = $image_name;
                $slider->save();
            }


            return redirect()->route('admin.dashboard');
        }
    }
    public function userStore(Request $request)
    {

        $rules = [
            'name' => 'required',
            'description' => 'required',
            'cat_id' => 'required',
            'sub_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required|max:11',
            'thumbnail_image' => 'required',
            'slider_images' => 'required|array',
            "video_thumbnail" => "",
            "video_id" => "",
            "address" => ""
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();


        if ($validatedData['thumbnail_image']) {
            $image = $validatedData['thumbnail_image'];
            $extention = $image->getClientOriginalExtension();
            $image_name = 'Property-slider' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
            $image_name = 'uploads/section-images/' . $image_name;
            Image::make($image)
                ->encode('webp', 80)
                ->save(public_path() . '/' . $image_name);

            $section = new Section();
            $section->name = $validatedData['name'];
            $section->description = $validatedData['description'];
            $section->cat_id = $validatedData['cat_id'];
            $section->sub_id = $validatedData['sub_id'];
            $section->city_id = $validatedData['city_id'];
            $section->image = $image_name;
            $section->phone = $validatedData['phone'];
            $section->address = $validatedData['address'];
            $section->video_id = $validatedData['video_id'];
            $section->user_id = Auth::user()->id;

            $section->save();

            foreach ($validatedData["slider_images"] as $image) {

                $extention = $image->getClientOriginalExtension();
                $image_name = 'Property-slider' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/section-images/' . $image_name;
                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);
                $slider = new Section_image();
                $slider->section_id = $section->id;
                $slider->image = $image_name;
                $slider->save();
            }


            return redirect()->route('user.dashboard');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        $sliders = Section_image::where("section_id", $id)->get();

        return view('section_show', compact("section", 'sliders'));
    }
    public function list()
    {
        $sections = Section::all();
        $today = carbon::today();
        return view('admin.agent_sections', compact('sections', 'today'));
    }
    public function awaitingList()
    {
        $today = carbon::today();
        $sections = Section::where('expired_date', '<', $today)->get();
        
        return view('admin.agent_sections', compact('sections', 'today'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $setting = Setting::first();

        $user = Auth::guard('web')->user();

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


        $cities = City::all();



        $section = Section::find($id);

        $existing_sliders = Section_image::where('section_id', $id)->get();









        return view('user.section_edit')->with([
            'mobile_app' => $mobile_app,
            'cities' => $cities,
            'section' => $section,
            'existing_sliders' => $existing_sliders,

        ]);
    }
    public function adminEdit($id)
    {

        $setting = Setting::first();



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


        $cities = City::all();



        $section = Section::find($id);

        $existing_sliders = Section_image::where('section_id', $id)->get();









        return view('admin.section_edit')->with([
            'mobile_app' => $mobile_app,
            'cities' => $cities,
            'section' => $section,
            'existing_sliders' => $existing_sliders,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $section = Section::find($id);

        $rules = [
            'name' => 'required|unique:sections,name,' . $id,
            'description' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('user_validation.Title is required'),
            'title.unique' => trans('user_validation.Title already exist'),
            'slug.required' => trans('user_validation.Slug is required'),
            'slug.unique' => trans('user_validation.Slug already exist'),
            'property_type_id.required' => trans('user_validation.Property type is required'),
            'purpose.required' => trans('user_validation.Purpose is required'),
            'rent_period.required' => trans('user_validation.Rent period is required'),
            'price.required' => trans('user_validation.Price is required'),
            'description.required' => trans('user_validation.Description is required'),
            'city_id.required' => trans('user_validation.City is required'),
            'address.required' => trans('user_validation.Address is required'),
            'address_description.required' => trans('user_validation.Address details is required'),
            'google_map.required' => trans('user_validation.Google map is required'),
            'total_area.required' => trans('user_validation.Total area is required'),
            'total_unit.required' => trans('user_validation.Total unit is required'),
            'total_bedroom.required' => trans('user_validation.Total bedroom is required'),
            'total_bathroom.required' => trans('user_validation.Total bathroom is required'),
            'total_garage.required' => trans('user_validation.Total garage is required'),
            'total_kitchen.required' => trans('user_validation.Total kitchen is required')
        ];

        $this->validate($request, $rules, $customMessages);
        $section->name = $request->name;


        $section->description = $request->description;



        $section->city_id = $request->city_id;
        $section->address = $request->address;
        $section->video_id = $request->video_id;
        if ($request->thumbnail_image) {
            $old_thumbnail_image = $section->image;
            $extention = $request->thumbnail_image->getClientOriginalExtension();
            $image_name = 'property-thumb' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
            $image_name = 'uploads/custom-images/' . $image_name;
            Image::make($request->thumbnail_image)
                ->encode('webp', 80)
                ->save(public_path() . '/' . $image_name);
            $section->image = $image_name;

            if ($old_thumbnail_image) {
                if (File::exists(public_path() . '/' . $old_thumbnail_image)) unlink(public_path() . '/' . $old_thumbnail_image);
            }
        }
        $section->save();







        if ($request->slider_images) {
            foreach ($request->slider_images as $index => $image) {
                $extention = $image->getClientOriginalExtension();
                $image_name = 'Property-slider' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);

                $slider = new Section_image();
                $slider->section_id = $section->id;
                $slider->image = $image_name;
                $slider->save();
            }
        }


        $notification = trans('user_validation.Update succssfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('user.property.index')->with($notification);
    }
    public function adminUpdate(Request $request, $id)
    {

        $section = Section::find($id);

        $rules = [
            'name' => 'required|unique:sections,name,' . $id,
            'description' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('user_validation.Title is required'),
            'title.unique' => trans('user_validation.Title already exist'),
            'slug.required' => trans('user_validation.Slug is required'),
            'slug.unique' => trans('user_validation.Slug already exist'),
            'property_type_id.required' => trans('user_validation.Property type is required'),
            'purpose.required' => trans('user_validation.Purpose is required'),
            'rent_period.required' => trans('user_validation.Rent period is required'),
            'price.required' => trans('user_validation.Price is required'),
            'description.required' => trans('user_validation.Description is required'),
            'city_id.required' => trans('user_validation.City is required'),
            'address.required' => trans('user_validation.Address is required'),
            'address_description.required' => trans('user_validation.Address details is required'),
            'google_map.required' => trans('user_validation.Google map is required'),
            'total_area.required' => trans('user_validation.Total area is required'),
            'total_unit.required' => trans('user_validation.Total unit is required'),
            'total_bedroom.required' => trans('user_validation.Total bedroom is required'),
            'total_bathroom.required' => trans('user_validation.Total bathroom is required'),
            'total_garage.required' => trans('user_validation.Total garage is required'),
            'total_kitchen.required' => trans('user_validation.Total kitchen is required')
        ];

        $this->validate($request, $rules, $customMessages);
        $section->name = $request->name;


        $section->description = $request->description;

        if ($request['expire_date']) {
            $section->approved_date = Carbon::today();
            $section->expired_date = $request['expire_date'];
        }

        $section->city_id = $request->city_id;
        $section->address = $request->address;
        $section->video_id = $request->video_id;
        if ($request->thumbnail_image) {
            $old_thumbnail_image = $section->image;
            $extention = $request->thumbnail_image->getClientOriginalExtension();
            $image_name = 'property-thumb' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
            $image_name = 'uploads/custom-images/' . $image_name;
            Image::make($request->thumbnail_image)
                ->encode('webp', 80)
                ->save(public_path() . '/' . $image_name);
            $section->image = $image_name;

            if ($old_thumbnail_image) {
                if (File::exists(public_path() . '/' . $old_thumbnail_image)) unlink(public_path() . '/' . $old_thumbnail_image);
            }
        }
        $section->save();







        if ($request->slider_images) {
            foreach ($request->slider_images as $index => $image) {
                $extention = $image->getClientOriginalExtension();
                $image_name = 'Property-slider' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.webp';
                $image_name = 'uploads/custom-images/' . $image_name;
                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path() . '/' . $image_name);

                $slider = new Section_image();
                $slider->section_id = $section->id;
                $slider->image = $image_name;
                $slider->save();
            }
        }


        $notification = trans('user_validation.Update succssfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect('admin/section/list')->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($section)
    {

        $section = Section::find($section);
        if ($section)
            if (Auth::user()->id == $section->user_id) {
                $section->delete();
                return redirect()->back();
            }
        return redirect()->back();
    }





    public function sections_with_ajax(Request $request)
    {

        $sections = Section::select('id', 'name', 'city_id', "image", "phone", 'sub_id')->where('expired_date', ">=", Carbon::today())->latest("id");
        if ($request->location) {

            $sections = $sections->where('city_id', $request->location);
        }
        if ($request->sub) {

            $sections = $sections->where('sub_id', $request->sub);
        }
        if ($request->cat_id) {

            $sections = $sections->where('cat_id', $request->cat_id);
        }


        $sections = $sections->paginate(20);
        $sections = $sections->appends($request->all());
        $subs = Sub::where('status', '1')->get();
        return view('sections_with_ajax')->with(['sections' => $sections, 'subs' => $subs]);
    }
}
