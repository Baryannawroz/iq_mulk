@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Cities')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Cities')}}</h1>

        </div>

        <div class="section-body">
            <a href="/admin/category/create" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add
                New')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{__('admin.SN')}}</th>
                                        <th>{{__('admin.category')}}</th>

                                        <th>{{__('admin.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $cat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cat->name }}</td>

                                        <td>
                                            <a href="/admin/category2/{{$cat->id}}/edit"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"
                                                    aria-hidden="true"></i></a>

                                          @if ($cat->status === 1)
                                            <a href="/admin/category/{{ $cat->id }}/deactivate" class="btn btn-success btn-sm">
                                                <i class="fa fa-check" aria-hidden="true"></i> <!-- Check icon for active -->
                                            </a>
                                            @else
                                            <a href="/admin/category/{{ $cat->id }}/activate" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times" aria-hidden="true"></i> <!-- Times icon for inactive -->
                                            </a>
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<a href="/lang/en">English</a>
<a href="/lang/kur">kurd</a>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/city/") }}'+"/"+id)
    }
</script>
@endsection
