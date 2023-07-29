@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Nearest Location')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Nearest Location')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.nearest-location.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Nearest Location')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.nearest-location.update', $location->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="">{{__('admin.Location')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="location" value="{{ $location->location }}">
                            </div>

                            <div class="form-group">
                                <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option {{ $location->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                    <option {{ $location->status == 0 ? 'selected' : '' }} value="0">{{__('admin.InActive')}}</option>
                                </select>
                            </div>

                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
