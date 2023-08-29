@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Agent All sections')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{__('user.Section list')}}</h1>
        </div>


        <div class="section-body">
            <a href="/admin/section/create" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="table-responsive table-invoice">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="5%">{{__('admin.SN')}}</th>
                                        <th width="15%">{{__('user.section')}}</th>
                                        <th width="10%">{{__('user.expired_date')}}</th>
                                        <th width="10%">{{__('admin.Status')}}</th>
                                        <th width="15%">{{__('admin.Action')}}</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $index => $section)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>
                                                <a target="_blank" href="section/show/{{ $section->id }}">{{ html_decode($section->name) }}</a>
                                            </td>
                                            <td>
                                                <p  class="text-bold text-center">{{ html_decode( $section->expired_date->format('d/m/Y') ) }}</p>
                                            </td>


                                            <td>
                                                @if ($section->expired_date >= $today)
                                                        <span class="badge badge-success">{{__('admin.Enable')}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{__('admin.Disable')}}</span>
                                                    @endif
                                            </td>

                                            <td>
                                                <a href="/admin/section/edit/{{ $section->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $section->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/property/") }}'+"/"+id)
    }
</script>
@endsection
