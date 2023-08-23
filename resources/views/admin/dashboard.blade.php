@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Dashboard')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Dashboard')}}</h1>
        </div>

        <div class="section-body">


<div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 ">
                <h4 class="dashboard_title text-center">{{__('admin.Today')}}</h4>
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.New User')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $today_users }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <h4 class="dashboard_title text-center">{{__('admin.This Month')}}</h4>
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.New User')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $monthly_users }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <h4 class="dashboard_title text-center">{{__('admin.This Year')}}</h4>
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.New User')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $yearly_users }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <h4 class="dashboard_title text-center">{{__('admin.Total')}}</h4>
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.New User')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_users }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-right">
                <h4 class="dashboard_title">{{__('admin.Property')}}</h4>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Own Property')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_own_property }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Total Property')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_property }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Publish Property')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_publish_property }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Awaiting Property')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $awaiting_property }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Reject Property')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $reject_property }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Total Agent')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_agent }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 text-right">
                <h4 class="dashboard_title">{{__('user.Section')}}</h4>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Own Section')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_own_section }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Total Section')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_section }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Publish Section')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_publish_section }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.Awaiting Section')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $awaiting_section }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('admin.expired Section')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $expired_section }}
                        </div>
                    </div>
                </div>
            </div>



        </div>
</div>
</section>

</div>

@endsection
