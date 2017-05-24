@extends('layouts.backend')

@push('plugin_css')
<link href="{{ url('assets') }}/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endpush

@push('page_css')
@endpush

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Canang
                <small>Kelola</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('admin.canang.manage') }}">Canang</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Detail</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-6 ">

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Informasi Paket </span>
                    </div>
                </div>

                <div class="portlet-body form">

                    <div class="form-body">
                        <table class="table table-bordered m-n" cellspacing="0">
                            <tbody>
                            <tr>
                                <td>
                                    <img src="{{ url('assets/img/paket/'.$model->image) }}" class="img-responsive">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Nama Paket</small></h4>
                                    <h4>{{ $model->nama_paket }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Harga</small></h4>
                                    <h4>{{ number_format($model->harga,0,',','.') }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Status</small></h4>
                                    <h4>{{ $model->getStatus() }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Keterangan</small></h4>
                                    <h4>{{ $model->keterangan }}</h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6 ">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Detail Paket</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <table class="table table-bordered m-n" cellspacing="0">
                        <tbody>
                        @foreach($model->canang_detail as $detail)
                            <tr>
                                <td>
                                    <h4>{{ $detail->qty }} X {{ $detail->label }}</h4>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@push('plugin_scripts')
<script src="{{ url('assets') }}/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@endpush

@push('scripts')

@endpush