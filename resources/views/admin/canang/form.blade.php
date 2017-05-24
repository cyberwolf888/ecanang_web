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
            <span class="active">Buat</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">

        {!! Form::open(['route' => isset($update) ? ['admin.canang.update', $model->id] : 'admin.canang.store', 'files' => true]) !!}
        <div class="col-md-6 ">

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Tambah Data Baru</span>
                    </div>
                </div>

                <div class="portlet-body form">

                    <div class="form-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                <h4 class="alert-heading">Ooppss ada error.</h4>
                                @foreach ($errors->all() as $error)
                                    <p><i class="fa fa-close font-red-mint"></i>&nbsp;{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group last">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ url('assets') }}/backend/global/img/no_image.png" alt="" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="image"> </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('nama_paket') ? ' has-error' : '' }}">
                            {!! Form::text('nama_paket', $model->nama_paket, ['id'=>'nama_paket','placeholder'=>'','class'=>'form-control', 'required']) !!}
                            <label for="nama_paket">Nama Paket</label>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('harga') ? ' has-error' : '' }}">
                            {!! Form::number('harga', $model->harga, ['id'=>'harga','placeholder'=>'','class'=>'form-control', 'required']) !!}
                            <label for="harga">Harga</label>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('status') ? ' has-error' : '' }}">
                            {!! Form::select('status', ['1'=>'Tersedia','0'=>'Tidak Tersedia'], $model->status,['id'=>'status','placeholder'=>'','class'=>'form-control', 'required']) !!}
                            <label for="status">Status</label>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            {!! Form::textarea('keterangan', $model->keterangan, ['id'=>'keterangan','placeholder'=>'','class'=>'form-control','rows'=>3]) !!}
                            <label for="keterangan">Keterangan</label>
                        </div>

                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn blue">Simpan</button>
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
                    @if(isset($update))
                        <div class="input_fields_wrap">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-circle blue add_field_button"> <i class="fa fa-plus"></i>Add More Fields</button>
                                </div>
                            </div>
                            <br>
                            @foreach($model->canang_detail as $detail)
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="btn red btn-del"> <i class="fa fa-trash"></i></button>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        {!! Form::text('label[]', $detail->label, ['id'=>'label[]','placeholder'=>'','class'=>'form-control', 'required']) !!}
                                        <label for="label[]">Label</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        {!! Form::number('qty[]', $detail->qty, ['id'=>'qty[]','placeholder'=>'','class'=>'form-control', 'required']) !!}
                                        <label for="qty[]">Qty</label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="input_fields_wrap">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-circle blue add_field_button"> <i class="fa fa-plus"></i>Add More Fields</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="btn red btn-del"> <i class="fa fa-trash"></i></button>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        {!! Form::text('label[]', null, ['id'=>'label[]','placeholder'=>'','class'=>'form-control', 'required']) !!}
                                        <label for="label[]">Label</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        {!! Form::number('qty[]', null, ['id'=>'qty[]','placeholder'=>'','class'=>'form-control', 'required']) !!}
                                        <label for="qty[]">Qty</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        </form>
    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@push('plugin_scripts')
<script src="{{ url('assets') }}/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@endpush

@push('scripts')

<script>
    $(document).ready(function() {
        var max_fields      = 100; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                $(wrapper).append(
                    '<div class="row">' +

                    '<div class="col-md-2">' +
                        '<button type="button" class="btn red btn-del"> <i class="fa fa-trash"></i></button>' +
                    '</div>'+

                    '<div class="col-md-5">'+
                        '<div class="form-group form-md-line-input">'+
                            '<?php echo Form::text('label[]', null, ['id'=>'label[]','placeholder'=>'','class'=>'form-control', 'required']); ?>' +
                            '<label for="label[]">Label</label>' +
                        '</div> ' +
                    '</div> ' +

                    '<div class="col-md-5">'+
                        '<div class="form-group form-md-line-input">'+
                            '<?php echo Form::number('qty[]', null, ['id'=>'qty[]','placeholder'=>'','class'=>'form-control', 'required']); ?>' +
                            '<label for="qty[]">Qty</label>' +
                        '</div> ' +
                    '</div> ' +

                    '</div>' ); //add input box
            }
        });
        $(wrapper).on("click",".btn-del", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
        })
    });
</script>

@endpush