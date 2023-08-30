@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit property')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Edit property')}}</h1>
        </div>


        <div class="section-body property_box ">

            <div id="hidden-location-box" class="d-none">
                <div class="delete-dynamic-location d-none">
                    <div class="row d-none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('admin.Nearest Location')}}</label>
                                <select name="nearest_locations[]" id="" class="form-control">
                                    <option value="">{{__('admin.Select')}}</option>
                                    @foreach ($nearest_locations as $nearest_location)
                                    <option value="{{ $nearest_location->id }}">{{ $nearest_location->location }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{__('admin.Distance(km)')}}</label>
                                <input type="text" class="form-control" name="distances[]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button"
                                class="btn btn-danger nearest-row-btn removeNearestPlaceRow plus_btn"><i
                                    class="fas fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>


            </div>

            <div id="hidden-addition-box" class="d-none">
                <div class="delete-dynamic-additio">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('admin.Key')}}</label>
                                <input type="text" class="form-control" name="add_keys[]">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{__('admin.Value')}}</label>
                                <input type="text" class="form-control" name="add_values[]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger nearest-row-btn removeAdditioanRow plus_btn"><i
                                    class="fas fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>


            </div>

            <div id="hidden-plan-box" class="d-none">
                <div class="delete-dynamic-plan">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('admin.Image')}}</label>
                                <input type="file" class="form-control-file" name="plan_images[]">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger nearest-row-btn removePlanRow plus_btn"><i
                                    class="fas fa-trash" aria-hidden="true"></i> {{__('admin.Remove Plan')}}</button>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" class="form-control" name="plan_titles[]">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <textarea name="plan_descriptions[]" id="" class="form-control text-area-5" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.property.index') }}" class="btn btn-primary"><i class="fas fa-list"></i>
                {{__('admin.Own Properties')}}</a>
            <form action="{{ route('admin.property.update', $property->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mt-4">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body" data-select2-id="select2-data-46-mub9">
                                <h4>{{__('admin.Basic Information')}}</h4>
                                <hr>




                                <div class="form-group d-none">
                                    <label for="slug">{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" class="form-control" id="slug"
                                        value="{{ html_decode($property->slug) }}">
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label for="title">{{__('admin.Title')}}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" id="title"
                                            value="{{ html_decode($property->title) }}">
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Property Type')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="property_type_id" id="property_type_id"
                                                class="form-control select2">
                                                <option value="">{{__('admin.Select')}}</option>
                                                @foreach ($types as $type)
                                                <option {{ $property->property_type_id == $type->id ? 'selected' : '' }}
                                                    value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purpose">{{__('admin.Purpose')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="purpose" id="purpose" class="form-control">
                                                <option {{ $property->purpose == 'sale' ? 'selected' : '' }}
                                                    value="sale">{{__('admin.For Sale')}}</option>
                                                <option {{ $property->purpose == 'rent' ? 'selected' : '' }}
                                                    value="rent">{{__('admin.For Rent')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if ($property->purpose == 'sale')
                                    <div class="col-md-3 col-12 d-none" id="rend_period_box">
                                        <div class="form-group">
                                            <label for="rent_period">{{__('admin.Rent Period')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="rent_period" id="rent_period" class="form-control">
                                                <option {{ $property->rent_period == 'daily' ? 'selected' : '' }}
                                                    value="daily">{{__('admin.Daily')}}</option>
                                                <option {{ $property->rent_period == 'monthly' ? 'selected' : '' }}
                                                    value="monthly">{{__('admin.Monthly')}}</option>
                                                <option {{ $property->rent_period == 'yearly' ? 'selected' : '' }}
                                                    value="yearly">{{__('admin.Yearly')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($property->purpose != 'sale')
                                    <div class="col-md-3 col-12" id="rend_period_box">
                                        <div class="form-group">
                                            <label for="rent_period">{{__('admin.Rent Period')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="rent_period" id="rent_period" class="form-control">
                                                <option {{ $property->rent_period == 'daily' ? 'selected' : '' }}
                                                    value="daily">{{__('admin.Daily')}}</option>
                                                <option {{ $property->rent_period == 'monthly' ? 'selected' : '' }}
                                                    value="monthly">{{__('admin.Monthly')}}</option>
                                                <option {{ $property->rent_period == 'yearly' ? 'selected' : '' }}
                                                    value="yearly">{{__('admin.Yearly')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="price">{{__('admin.Price')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="price" class="form-control"
                                                value="{{ html_decode($property->price) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Total Area(m2)')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="total_area" class="form-control"
                                                value="{{ html_decode($property->total_area) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Total Unit')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="total_unit" class="form-control"
                                                value="{{ $property->total_unit }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Total Bedroom')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="total_bedroom" class="form-control"
                                                value="{{ $property->total_bedroom }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Total Bathroom')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="total_bathroom" class="form-control"
                                                value="{{ $property->total_bathroom }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Total Garage')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="total_garage" class="form-control"
                                                value="{{ $property->total_garage }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Total Kitchen')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="total_kitchen" class="form-control"
                                                value="{{ $property->total_kitchen }}">
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">{{__('admin.Description')}} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description" id="description" cols="30" rows="5"
                                                class="col-12 form-control h-25">{!! (($property->description)) !!}</textarea>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="card">
                            <div class="card-body" data-select2-id="select2-data-46-mub9">
                                <h4>{{__('admin.Location')}}</h4>
                                <hr>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('admin.City')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="city_id" id="city_id" class="form-control select2">
                                                <option value="">{{__('admin.Select')}}</option>
                                                @foreach ($cities as $city)
                                                <option {{ $property->city_id == $city->id ? 'selected' : '' }}
                                                    value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">{{__('admin.Address')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ html_decode($property->address) }}">
                                        </div>
                                    </div>

                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label for="address_description">{{__('admin.Address Details')}} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="address_description" class="form-control text-area-5" id=""
                                                cols="30"
                                                rows="10">{{ html_decode($property->address_description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label for="google_map">{{__('admin.Google Map')}} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="google_map" class="form-control text-area-5" id="" cols="30"
                                                rows="10">{{ html_decode($property->google_map) }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="card">
                            <div class="card-body" data-select2-id="select2-data-46-mub9">
                                <h4>{{__('user.expired_date')}}</h4>
                                <hr>
                                <div class="row">

f


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">{{__('admin.expired_date')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" required name="expired_date" class="form-control"
                                            @if ($property->expired_date)

                                            value="{{ $property->expired_date->format('Y-m-d') }}"
                                            @endif
                                            >
                                        </div>
                                    </div>

                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label for="address_description">{{__('admin.Address Details')}} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="address_description" class="form-control text-area-5" id=""
                                                cols="30"
                                                rows="10">{{ html_decode($property->address_description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label for="google_map">{{__('admin.Google Map')}} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="google_map" class="form-control text-area-5" id="" cols="30"
                                                rows="10">{{ html_decode($property->google_map) }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h4>{{__('admin.Image and Video')}}</h4>
                                <hr>
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Existing Slider')}}</label>
                                            <div class="row">

                                                @foreach ($existing_sliders as $existing_slider)
                                                <div class="col-lg-4 col-md-6 image-box mb-4">
                                                    <div class="property-slider-image">
                                                        <img src="{{ asset($existing_slider->image) }}" alt="">
                                                        <span data-id="{{ $existing_slider->id }}"
                                                            class="remove_existing_image"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Slider Image')}} ({{__('admin.Multiple')}})
                                            </label>
                                            <input type="file" name="slider_images[]" multiple
                                                class="form-control-file">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Existing Thumbnail')}}</label>
                                            <div>
                                                <img class="w_300" src="{{ asset($property->thumbnail_image) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Thumbnail Image')}} </label>
                                            <input type="file" name="thumbnail_image" class="form-control-file">
                                        </div>
                                    </div>

                                    @if ($property->video_thumbnail)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Existing Video Thumbnail')}}</label>
                                            <div>
                                                <img class="w_300" src="{{ asset($property->video_thumbnail) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Video Thumbnail Image')}}</label>
                                            <input type="file" name="video_thumbnail" class="form-control-file">
                                        </div>
                                    </div>

                                    @if ($property->video_id)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Existing Video')}}</label>
                                            <div>
                                                <iframe width="300" height="150"
                                                    src="https://www.youtube.com/embed/{{ html_decode($property->video_id) }}">
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Youtube video id')}} </label>
                                            <input type="text" name="video_id" class="form-control"
                                                value="{{ html_decode($property->video_id) }}">
                                        </div>
                                    </div>

                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Video description')}} </label>
                                            <textarea name="video_description" class="form-control text-area-3" id=""
                                                cols="30"
                                                rows="10">{{ html_decode($property->video_description) }}</textarea>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="card-body">
                                <h4>{{__('admin.Aminities')}}</h4>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div>
                                                @foreach ($aminities as $aminity)

                                                @php
                                                $is_checked=false;
                                                @endphp
                                                @foreach ($existing_properties as $amnty)
                                                @if ($aminity->id == $amnty->aminity_id)
                                                @php
                                                $is_checked=true;
                                                @endphp
                                                @endif
                                                @endforeach

                                                <input {{ $is_checked ? 'checked' :'' }} value="{{ $aminity->id }}"
                                                    type="checkbox" name="aminities[]" id="aminity{{ $aminity->id }}">

                                                <label class="mx-1" for="aminity{{ $aminity->id }}">{{ $aminity->aminity
                                                    }}</label>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card d-none">
                            <div class="card-body">
                                <h4>{{__('admin.Nearest Location')}}</h4>
                                <hr>
                                <div class="row">

                                    <div class="col-12" id="nearest-place-box">

                                        @foreach ($existing_nearest_locations as $existing_nearest_location)
                                        <div class="delete-dynamic-location">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Nearest Location')}}</label>
                                                        <select name="existing_nearest_locations[]" id=""
                                                            class="form-control">
                                                            <option value="">{{__('admin.Select')}}</option>
                                                            @foreach ($nearest_locations as $nearest_location)
                                                            <option {{ $existing_nearest_location->nearest_location_id
                                                                == $nearest_location->id ? 'selected' : '' }} value="{{
                                                                $nearest_location->id }}">{{ $nearest_location->location
                                                                }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Distance(km)')}}</label>
                                                        <input name="existing_distances[]" type="text"
                                                            class="form-control"
                                                            value="{{ html_decode($existing_nearest_location->distance) }}">
                                                    </div>

                                                    <input name="existing_nearest_ids[]" type="hidden"
                                                        class="form-control"
                                                        value="{{ $existing_nearest_location->id }}">

                                                </div>
                                                <div class="col-md-2">
                                                    <button data-id="{{ $existing_nearest_location->id }}" type="button"
                                                        class="btn btn-danger nearest-row-btn existingRemoveNearestPlaceRow plus_btn"><i
                                                            class="fas fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Nearest Location')}}</label>
                                                    <select name="nearest_locations[]" id="" class="form-control">
                                                        <option value="">{{__('admin.Select')}}</option>
                                                        @foreach ($nearest_locations as $nearest_location)
                                                        <option value="{{ $nearest_location->id }}">{{
                                                            $nearest_location->location }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Distance(km)')}}</label>
                                                    <input type="text" class="form-control" name="distances[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button id="addNearestPlaceRow" type="button"
                                                    class="btn btn-success nearest-row-btn plus_btn"><i
                                                        class="fas fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card d-none">
                            <div class="card-body">
                                <h4>{{__('admin.Additional Information')}}</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-12" id="additional-box">
                                        @foreach ($existing_add_informations as $existing_add_information)
                                        <div class="delete-dynamic-additio">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Key')}}</label>
                                                        <input type="text" class="form-control"
                                                            name="existing_add_keys[]"
                                                            value="{{ html_decode($existing_add_information->add_key) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Value')}}</label>
                                                        <input type="text" class="form-control"
                                                            name="existing_add_values[]"
                                                            value="{{ html_decode($existing_add_information->add_value) }}">

                                                        <input type="hidden" class="form-control"
                                                            name="existing_add_ids[]"
                                                            value="{{ $existing_add_information->id }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button data-id="{{ $existing_add_information->id }}" type="button"
                                                        class="btn btn-danger nearest-row-btn existingRemoveAdditioanRow plus_btn"><i
                                                            class="fas fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Key')}}</label>
                                                    <input type="text" class="form-control" name="add_keys[]">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Value')}}</label>
                                                    <input type="text" class="form-control" name="add_values[]">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button id="addAdditionalRow" type="button"
                                                    class="btn btn-success nearest-row-btn plus_btn"><i
                                                        class="fas fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card d-none">
                            <div class="card-body">
                                <h4>{{__('admin.Property Plan')}}</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-12" id="plan-box">
                                        @foreach ($existing_plans as $existing_plan)
                                        <div class="delete-dynamic-plan">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Image')}}</label>
                                                        <div>
                                                            <img src="{{ asset($existing_plan->image) }}" alt=""
                                                                class="w_300">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Image')}}</label>
                                                        <input type="file" class="form-control-file"
                                                            name="existing_plan_image_{{ $existing_plan->id }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <button data-id="{{ $existing_plan->id }}" type="button"
                                                        class="btn btn-danger nearest-row-btn existingRemovePlanRow plus_btn"><i
                                                            class="fas fa-trash" aria-hidden="true"></i>
                                                        {{__('admin.Remove Plan')}}</button>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Title')}}</label>
                                                        <input type="text" class="form-control"
                                                            name="existing_plan_titles[]"
                                                            value="{{ html_decode($existing_plan->title) }}">
                                                    </div>

                                                    <input type="hidden" class="form-control" name="existing_plan_ids[]"
                                                        value="{{ $existing_plan->id }}">

                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Description')}}</label>
                                                        <textarea name="existing_plan_descriptions[]" id=""
                                                            class="form-control text-area-5" cols="30"
                                                            rows="10">{{ html_decode($existing_plan->description) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Image')}}</label>
                                                    <input type="file" class="form-control-file" name="plan_images[]">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <button id="addNewPlan" type="button"
                                                    class="btn btn-success nearest-row-btn plus_btn"><i
                                                        class="fas fa-plus" aria-hidden="true"></i> {{__('admin.New
                                                    Plan')}}</button>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Title')}}</label>
                                                    <input type="text" class="form-control" name="plan_titles[]">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Description')}}</label>
                                                    <textarea name="plan_descriptions[]" id=""
                                                        class="form-control text-area-5" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h4>{{__('admin.SEO Information and Others')}}</h4>
                                <hr>
                                <div class="row">


                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="control-label">{{__('admin.Status')}}</div>
                                            <label class=" mt-2">
                                                <input {{ $property->status == 'enable' ? 'checked' : '' }}
                                                type="checkbox" name="status" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">{{__('admin.Enable /
                                                    Disable')}}</span>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="control-label">{{__('user.prozhakan')}}</div>
                                            <label class=" mt-2">
                                                <input {{ $property->is_featured == 'enable' ? 'checked' : '' }}
                                                type="checkbox" name="is_featured" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">
                                                    {{__('admin.Enable / Disable')}}</span>
                                            </label>
                                        </div>
                                    </div>




                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="control-label">{{__('admin.Featured')}}</div>
                                            <label class=" mt-2">
                                                <input {{ $property->is_top == 'enable' ? 'checked' : '' }}
                                                type="checkbox" name="is_top" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">
                                                    {{__('admin.Enable / Disable')}}</span>
                                            </label>
                                        </div>
                                    </div>



                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="control-label">{{__('user.Urgent Property')}}</div>
                                            <label class=" mt-2">
                                                <input {{ $property->is_urgent == 'enable' ? 'checked' : '' }}
                                                type="checkbox" name="is_urgent" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">
                                                    {{__('admin.Enable / Disable')}}</span>
                                            </label>
                                        </div>
                                    </div>




                                    @if ($property->agent_id != 0)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.Moderator Status')}} </label>
                                            <select name="approve_by_admin" id="" class="form-control">
                                                <option {{ $property->approve_by_admin == 'pending' ? 'selected' : '' }}
                                                    value="pending">{{__('admin.Awaiting')}}</option>
                                                <option {{ $property->approve_by_admin == 'approved' ? 'selected' : ''
                                                    }} value="approved">{{__('admin.Approved')}}</option>
                                                <option {{ $property->approve_by_admin == 'reject' ? 'selected' : '' }}
                                                    value="reject">{{__('admin.Reject')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.SEO Title')}} </label>
                                            <input type="text" name="seo_title" class="form-control"
                                                value="{{ html_decode($property->seo_title) }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('admin.SEO Meta Description')}} </label>
                                            <textarea name="seo_meta_description" class="form-control text-area-5" id=""
                                                cols="30"
                                                rows="10">{{ html_decode($property->seo_meta_description) }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
</div>

<script src="{{ asset($path.'backend/js/select2.min.js') }}"></script>
<script>
    (function($) {
    "use strict";
    $(document).ready(function () {

        // slug generate and check

        $("#title").on("focusout",function(e){
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
                url:"{{url('/admin/remove-nearest-location/')}}"+"/"+id,
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
                url:"{{url('/admin/remove-add-infor/')}}"+"/"+id,
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
                url:"{{url('/admin/remove-plan/')}}"+"/"+id,
                success:function(response){

                },
                error:function(err){}
            })
        });

        //end dynamic plan  add and remove

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
                url:"{{url('/admin/remove-property-slider/')}}"+"/"+id,
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
