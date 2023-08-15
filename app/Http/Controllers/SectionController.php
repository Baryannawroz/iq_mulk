<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Category;
use App\Models\City;
use App\Models\PropertySlider;
use App\Models\Section;
use App\Models\Section_image;
use App\Models\SeoSetting;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

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


        return view("sections", compact("cat_id", "subs", 'cities','seo_setting', "property_types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::select('id', 'name')->get();
        $cats = Cat::select('id', 'name')->where('status',1)->get();
        $subs = Sub::select('id', 'name')->where('status', 1)->get();

        return view("admin.section_create", compact("cities", 'cats', 'subs'));
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
            'slider_images' => 'required|array'
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function sections_with_ajax(Request $request)
    {

        $sections = Section::select('id', 'name', 'city_id', "image","phone",'sub_id')->where('status', '1')->latest("id");
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
        $subs = Sub::where('status','1')->get();
        return view('sections_with_ajax')->with(['sections' => $sections, 'subs' => $subs]);
    }
}
