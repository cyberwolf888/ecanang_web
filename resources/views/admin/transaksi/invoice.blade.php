<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>Canang Sari</title>
    <style>
        .invoice-box{
            max-width:800px;
            margin:auto;
            padding:30px;
            border:1px solid #eee;
            box-shadow:0 0 10px rgba(0, 0, 0, .15);
            font-size:16px;
            line-height:24px;
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color:#555;
        }

        .invoice-box table{
            width:100%;
            line-height:inherit;
            text-align:left;
        }

        .invoice-box table td{
            padding:5px;
            vertical-align:top;
        }

        .invoice-box table tr td:nth-child(2){
            text-align:right;
        }

        .invoice-box table tr.top table td{
            padding-bottom:20px;
        }

        .invoice-box table tr.top table td.title{
            font-size:45px;
            line-height:45px;
            color:#333;
        }

        .invoice-box table tr.information table td{
            padding-bottom:40px;
        }

        .invoice-box table tr.heading td{
            background:#eee;
            border-bottom:1px solid #ddd;
            font-weight:bold;
        }

        .invoice-box table tr.details td{
            padding-bottom:20px;
        }

        .invoice-box table tr.item td{
            border-bottom:1px solid #eee;
        }

        .invoice-box table tr.item.last td{
            border-bottom:none;
        }

        .invoice-box table tr.total td:nth-child(2){
            border-top:2px solid #eee;
            font-weight:bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td{
                width:100%;
                display:block;
                text-align:center;
            }

            .invoice-box table tr.information table td{
                width:100%;
                display:block;
                text-align:center;
            }
        }
    </style>
</head>
<body>
    <div id="invoice">
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ url('assets') }}/backend/layouts/layout4/img/logo-small.png" style="width:100%; max-width:300px;">
                                </td>

                                <td>
                                    Invoice #: {{ $model->id }}<br>
                                    Created: <?= date("F d, Y",strtotime($model->created_at)) ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Canang Sari<br>
                                    Jalan Raya Gianyar<br>
                                    (0361) 8080
                                </td>

                                <td>
                                    <?= $model->user->name ?><br>
                                    <?= $model->user->telp ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>
                        Transaction Status
                    </td>

                    <td>
                    </td>
                </tr>

                <tr class="details">
                    <td>
                        {{ $model->getStatus() }}
                    </td>

                    <td>

                    </td>
                </tr>
                <tr class="heading">
                    <td>
                        Item
                    </td>

                    <td>
                        Price
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        {{ $model->canang->nama_paket }}
                    </td>
                    <td>
                        Rp {{ number_format($model->total,0,',','.') }}
                    </td>
                </tr>
                <tr class="total">
                    <td></td>

                    <td>
                        Total: Rp {{ number_format($model->total,0,',','.') }}
                    </td>
                </tr>
            </table>
            <br>
            <p style="font-size: 12px;font-style: italic;">Note: Barang yang sudah dibeli tidak dapat dikembalikan atau diuangkang lagi.</p>
        </div>
    </div>
<script>
    window.print();
    setTimeout(function () { window.close(); }, 100);
</script>
</body>
</html>