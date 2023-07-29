<div>
    <div class="form-group ">
        <label for="title">{{__('admin.category')}}<span class="text-danger">*</span></label>
        <select wire:model="cat_id" name="cat_id" id="cat_id" class="form-control select w-10">
            <option value="0">{{__('admin.Own Property')}}</option>
            @foreach ($cats as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="title">{{__('admin.subcategory')}}<span class="text-danger">*</span></label>
        <select name="sub_id" id="sub_id" class="form-control select">

            @foreach ($subs as $sub)
            @if ($cat_id==$sub->cat_id)

            <option value="{{ $sub->id }}">{{ $sub->name }} </option>
            @endif
            @endforeach
        </select>
    </div>
</div>
