@extends('layouts.backend')

@push('plugin_css')
<link href="{{ url('assets') }}/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/backend/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('page_css')
@endpush

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1> Laporan
                <small>Pilih Periode</small>
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
            <a href="{{ route('admin.laporan.priod') }}">Laporan</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Periode Laporan</span>
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
                        <span class="caption-subject bold uppercase"> Pilih Periode Laporan </span>
                    </div>
                </div>

                <div class="portlet-body form">
                    {!! Form::open(['route' => ['admin.laporan.result'], 'files' => true]) !!}
                    <div class="form-body">
                        <div class="form-group form-md-line-input {{ $errors->has('tgl_sewa') ? ' has-error' : '' }}">
                            {!! Form::text('start_date', null, ['id'=>'start_date','placeholder'=>'','class'=>'form-control date-picker', 'required', 'readonly']) !!}
                            <label for="nama">Start Date</label>
                        </div>
                        <div class="form-group form-md-line-input {{ $errors->has('tgl_sewa') ? ' has-error' : '' }}">
                            {!! Form::text('end_date', null, ['id'=>'end_date','placeholder'=>'','class'=>'form-control date-picker', 'required', 'readonly']) !!}
                            <label for="nama">End Date</label>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn blue">Submit</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@push('plugin_scripts')
<script src="{{ url('assets') }}/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="{{ url('assets') }}/backend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
@endpush

@push('scripts')
<script>
    jQuery(document).ready(function(){
        jQuery().datepicker&&$(".date-picker").datepicker({
            format: 'yyyy-mm-dd',
            orientation:"left",
            autoclose:!0
        });
        $(document).scroll(function(){$(".date-picker").datepicker("place")});
    });
</script>
@endpush