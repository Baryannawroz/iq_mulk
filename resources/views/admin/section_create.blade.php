@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create reklam')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Create reklam')}}</h1>
        </div>

        <div class="section-body property_box">



            <div id="hidden-addition-box" class="d-none">
                <div class="delete-dynamic-additio">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{__('user.Key')}}</label>
                                <input type="text" class="form-control" name="add_keys[]">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{__('user.Value')}}</label>
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
                                <label for="">{{__('user.Image')}}</label>
                                <input type="file" class="form-control-file" name="plan_images[]">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger nearest-row-btn removePlanRow plus_btn"><i
                                    class="fas fa-trash" aria-hidden="true"></i> {{__('usre.Remove Plan')}}</button>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">{{__('user.Title')}}</label>
                                <input type="text" class="form-control" name="plan_titles[]">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">{{__('user.Description')}}</label>
                                <textarea name="plan_descriptions[]" id="" class="form-control text-area-5" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('user.property.index') }}" class="btn btn-primary"><i class="fas fa-list"></i>
                {{__('admin.Own Properties')}}</a>
            <form id="property_form" action="/admin/section/store" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mt-4">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body" data-select2-id="select2-data-46-mub9">
                                <h4>{{__('user.Basic Information')}}</h4>
                                <hr>



                                <div class="form-group">
                                    <label for="title">{{__('user.Title')}}<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="title">
                                </div>

                                <div class="col-12">
                                    @livewireStyles
                                    <livewire:cat-sub-select :category="-1" :sub="-1"/>
                                    @livewireScripts
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{__('user.Phone')}} <span class="text-danger">*</span></label>
                                    <input type="text" max="11" name="phone" class="form-control" id="phone">
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">{{__('user.Description')}}</label>
                                        <textarea name="description" id="" required class="form-control text-area-5"
                                            cols="30" rows="10"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body" data-select2-id="select2-data-46-mub9">
                                <h4>{{__('user.Location')}}</h4>
                                <hr>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{__('user.City')}} <span
                                                    class="text-danger">*</span></label>
                                            <select name="city_id" id="city_id" class="form-control select2">
                                                <option value="">{{__('user.Select')}}</option>
                                                @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">{{__('user.Address')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body" data-select2-id="select2-data-46-mub9">
                                <h4>{{__('user.Offer')}}</h4>
                                <hr>
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">{{__('user.expire date')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control datepicker"
                                                placeholder="Select a date" name="expire_date">
                                        </div>
                                    </div>
                                    <div class=" col-md-6 col-12" id="top_box">
                                        <div class="form-group">
                                            <div class="control-label">{{__('admin.bussines reklam')}}</div>
                                            <label class=" mt-2">
                                                <input type="checkbox" name="vip" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">
                                                    {{__('admin.Enable / Disable')}}</span>
                                            </label>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4>{{__('user.images and videos')}}</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('user.Thumbnail Image')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="thumbnail_image" class="form-control-file">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('user.Slider Image')}}  <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="slider_images[]" multiple
                                                class="form-control-file">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('user.file secton')}}  <span
                                                    class="text-danger">*</span></label>
                                          <input type="file" accept=".pdf" name="pdf_file">
                                        </div>
                                    </div>



                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">{{__('user.Youtube video id')}} </label>
                                            <input type="text" name="video_id" class="form-control">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary save_btn">{{__('admin.Save')}}</button>
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

        // check agent package availability

        $("#owner_id").on("change", function(){
            let owner_id = $(this).val();

            if(owner_id != 0){
                $.ajax({
                    type:"get",
                    url:"{{url('/admin/agent-plan-availability/')}}"+"/"+owner_id,
                    success:function(response){

                        if(response.top_property == 'disable'){
                            $("#top_box").addClass('d-none');
                        }else{
                            $("#top_box").removeClass('d-none');
                        }

                        if(response.urgent_property == 'disable'){
                            $("#urgent_box").addClass('d-none');
                        }else{
                            $("#urgent_box").removeClass('d-none');
                        }

                        if(response.featured_property == 'disable'){
                            $("#featured_box").addClass('d-none');
                        }else{
                            $("#featured_box").removeClass('d-none');
                        }

                    },
                    error:function(err){
                        if(err.status == 403){
                            toastr.error(err.responseJSON.message);

                            $("#top_box").addClass('d-none');
                            $("#urgent_box").addClass('d-none');
                            $("#featured_box").addClass('d-none');

                        }
                    }
                })
            }else{
                $("#top_box").removeClass('d-none');
                $("#urgent_box").removeClass('d-none');
                $("#featured_box").removeClass('d-none');
            }

        })

        // check agent package availability

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
                    }
                }
            })
        })

        // slug generate and check

        // rent box handle

        $("#purpose").on("change",function(){
            var purpose = $(this).val()
            if(purpose == 'rent'){
                $("#rend_period_box").removeClass('d-none');
            }else{
                $("#rend_period_box").addClass('d-none');
            }
        })

        // rent box handle

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
