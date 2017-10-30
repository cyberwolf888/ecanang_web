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
            <a href="{{ route('admin.transaksi.manage') }}">Transaksi</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Detail</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->

    <div class="row">
        <div class="col-md-12 ">
            <a href="{{ route('admin.transaksi.invoice',$model->id) }}" class="btn blue btn-circle" target="_blank"><i class="fa fa-print"></i> Print Invoice</a>
        </div>
    </div>
    <br>

    @if($model->status != \App\Models\Transaksi::COMPLETE)
    <div class="row">
        <div class="col-md-12 ">

            @if($model->status == \App\Models\Transaksi::CONFIRMED)
            <a href="{{ route('admin.transaksi.dikirim',$model->id) }}" class="btn btn-circle yellow" id="finish">
                <i class="fa fa-check"></i> Kirim Barang
            </a>
            @endif

            @if($model->status == \App\Models\Transaksi::SHIPPED)
                <a href="{{ route('admin.transaksi.selesai',$model->id) }}" class="btn btn-circle green-jungle" id="finish">
                    <i class="fa fa-check"></i> Selesaikan Transaksi
                </a>
            @endif

            @if($model->status != \App\Models\Transaksi::CANCELED)
            <a href="{{ route('admin.transaksi.batal',$model->id) }}" class="btn btn-circle red-mint">
                <i class="fa fa-close"></i> Batalkan Transaksi
            </a>
            @endif
        </div>
    </div>
    <br>
    @endif

    <div class="row">
        <div class="col-md-6 ">

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Detail Transaksi </span>
                    </div>
                </div>

                <div class="portlet-body form">

                    <div class="form-body">
                        <table class="table table-bordered m-n" cellspacing="0">
                            <tbody>
                            <tr>
                                <td>
                                    <h4><small>ID Transaksi</small></h4>
                                    <h4>{{ $model->id }}</h4>
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
                                    <h4><small>Tgl Transaksi</small></h4>
                                    <h4>{{ date('d F Y',strtotime($model->created_at)) }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Nama Customer</small></h4>
                                    <h4>{{ $model->user->name }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Nama Paket</small></h4>
                                    <h4><a href="{{ route('admin.canang.detail',$model->canang_id) }}">{{ $model->canang->nama_paket }}</a> </h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Alamat Tujuan</small></h4>
                                    <h4>{{ $model->address }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Telp</small></h4>
                                    <h4>{{ $model->telp }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4><small>Total</small></h4>
                                    <h4>{{ number_format($model->total,0,',','.') }}</h4>
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
                        <span class="caption-subject bold uppercase"> Detail Pembayaran</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <table class="table table-bordered m-n" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>
                                <h4><small>Bukti Pembayaran</small></h4>
                                @if($model->img_bukti != "")
                                    @if($model->status == \App\Models\Transaksi::WAITING_VERIFIED)
                                        <a href="{{ route('admin.transaksi.confirmPayment',$model->id) }}" class="btn btn-circle green-jungle" id="finish">
                                            <i class="fa fa-check"></i> Terima Pembayaran
                                        </a>
                                        <a href="{{ route('admin.transaksi.cancelPayment',$model->id) }}" class="btn btn-circle red-mint">
                                            <i class="fa fa-close"></i> Tolak Pembayaran
                                        </a>
                                        <br><br>
                                    @endif
                                <img src="{{ url('assets/img/pembayaran/'.$model->img_bukti) }}" class="img-responsive">
                                @endif
                            </td>
                        </tr>
                        @if($model->feedback != '')
                        <tr>
                            <td>
                                <h4><small>Keterangan</small></h4>
                                <h4>{{ $model->feedback }}</h4>
                            </td>
                        </tr>
                        @endif
                        @if($model->img_feedback != '')
                        <tr>
                            <td>
                                <h4><small>Gambar Keterangan</small></h4>
                                <h4><img src="{{ url('assets/img/feedback/'.$model->img_feedback) }}" class="img-responsive"></h4>
                            </td>
                        </tr>
                        @endif
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