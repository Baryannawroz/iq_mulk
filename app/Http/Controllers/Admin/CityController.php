<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Str;
use App\Models\User;
use App\Models\Property;

use App\Exports\CityExport;
use App\Imports\CityImport;
use Maatwebsite\Excel\Facades\Excel;

use Image;
use File;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cities = City::orderBy('id', 'desc')->get();

        return view('admin.city', compact('cities'));
    }


    public function create()
    {
        return view('admin.create_city');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|unique:cities'
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.City is required'),
            'name.unique' => trans('admin_validation.City already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $city=new City();
        $city->name=$request->name;
        $city->slug=Str::slug($request->name).'-'.substr(rand(0,time()),0,5);
        $city->save();

        $notification=trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function edit($id)
    {
        $city = City::find($id);

        return view('admin.edit_city', compact('city'));
    }


    public function update(Request $request, $id)
    {
        $city = City::find($id);
        $rules = [
            'name'=>'required|unique:cities,name,'.$city->id
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.City is required'),
            'name.unique' => trans('admin_validation.City already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $city->name=$request->name;
        $city->slug=Str::slug($request->name).'-'.substr(rand(0,time()),0,5);
        $city->save();

        $notification=trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.city.index')->with($notification);
    }


    public function destroy($id)
    {
        $property_count = Property::where('city_id', $id)->count();

        if($property_count > 0){
            $notification=trans('admin_validation.In this item multiple property exist, so you can not delete this item');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.city.index')->with($notification);
        }

        $city = City::find($id);
        $city->delete();

        $notification=trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.city.index')->with($notification);
    }

    public function city_import(){
        return view('admin.city_import');
    }

    public function city_export(){
        return Excel::download(new CityExport, 'cities.xlsx');
    }

    public function store_import_city(Request $request){
        Excel::import(new CityImport, $request->file('file'));

        $notification=trans('admin_validation.Uploaded Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.city.index')->with($notification);
    }

    public function assign_homepage_city(){
        $cities = City::orderBy('id', 'desc')->get();

        return view('admin.assign_homepage_city', compact('cities'));
    }

    public function store_assign_homepage_city(Request $request){

        $rules = [
            'image'=>'required',
            'city_id'=>'required',
            'serial'=>'required',
        ];

        $customMessages = [
            'image.required' => trans('admin_validation.Image is required'),
            'city_id.required' => trans('admin_validation.City is required'),
            'serial.required' => trans('admin_validation.Serial is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $city = City::find($request->city_id);

        $count = City::where('id', $request->city_id)->where('show_homepage', 1)->count();

        if($count > 0){
            $notification=trans('admin_validation.City already assign');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        if($request->image){
            $exist_banner = $city->image;
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'city'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$banner_name);
            $city->image = $banner_name;
            $city->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $city->show_homepage = 1;
        $city->serial = $request->serial;
        $city->save();

        $notification=trans('admin_validation.Assign successful');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);


    }


    public function update_assign_homepage_city(Request $request, $id){

        $rules = [
            'serial'=>'required',
        ];

        $customMessages = [
            'serial.required' => trans('admin_validation.Serial is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $city = City::find($id);

        if($request->image){
            $exist_image = $city->image;
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'city'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $banner_name = 'uploads/custom-images/'.$banner_name;
            Image::make($request->image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$banner_name);
            $city->image = $banner_name;
            $city->save();
            if($exist_image){
                if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
            }
        }

        $city->serial = $request->serial;
        $city->save();

        $notification=trans('admin_validation.Update successful');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function remove_from_home($id){
        $city = City::find($id);
        $exist_image = $city->image;
        if($exist_image){
            if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
        }

        $city->show_homepage = 0;
        $city->serial = 0;
        $city->save();

        $notification=trans('admin_validation.Deleted successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }







}
