<div class="row">

    <div class="form-group col-lg-6 col-md-6 col-12 ">
        <label for="title">{{__('admin.category')}}<span class="text-danger">*</span></label>
        <select wire:model="cat_id" name="cat_id" id="cat_id" class="form-control select w-10" required>
            <option value="-1">کەتەگۆری</option>
            @foreach ($cats as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-lg-6 col-md-6 col-12">
        <label for="title">{{__('admin.subcategory')}}<span class="text-danger">*</span></label>
        <select name="sub_id" id="sub_id" class="form-control select" required>

            @foreach ($subs as $sub)

            @if ($cat_id==$sub->cat_id)
            <option value="{{ $sub->id }}" @if ($sub->id == $subb)
                {{ "selected" }}
                @endif>{{ $sub->name }} </option>
            @endif
            @endforeach
        </select>
    </div>
</div>