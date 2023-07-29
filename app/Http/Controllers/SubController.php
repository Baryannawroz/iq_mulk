<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Sub::latest('id')->get();
        return view("admin.subcategory", compact("subs"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Cat::select('name', 'id')->get();


        return view("admin.subcategory_create",compact("cats"));
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
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();


        Sub::create($validatedData);

        return redirect("/admin/subcategory")->with('success', 'Cat inserted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sub)
    {

        $sub=Sub::find($sub);
        $cats = Cat::all();
        return view('admin.subcategory_edit', compact('cats','sub'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'cat_id' => 'required',
            'id' => 'required',
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $record = Sub::find($validatedData['id']);
        $record->name = $validatedData['name'];
        $record->description = $validatedData['description'];
        $record->cat_id= $validatedData['cat_id'];
        $record->save();
        return redirect("/admin/subcategory")->with('success', 'Cat inserted successfully!');
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
    public function getSubcategories(Request $request)
    {
        dd($request->input('category_id'));
        $categoryId = $request->input('category_id');
        $subcategories = Cat::findOrFail($categoryId)->subcategories;
        return response()->json($subcategories);
    }


}
