<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('custom/assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/css/pages.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <style>
        @font-face {
            font-family: 'Telidon-Hv';
            src: url('Telidon-Hv.ttf');
            font-weight: normal;
            font-style: normal;
        }

        @page {
            margin: 0mm;
        }

        @media screen {
            body {
                background: #e0e0e0
            }

            body {
                margin: 5mm;
            }

            .sheet {
                background: white;
                box-shadow: 0 .5mm 2mm rgba(0, 0, 0, .3);
                margin: 5mm;
            }

            .sheet.padding-5mm {
                padding: 5mm
            }

            .sheet.padding-10mm {
                padding: 1mm
            }

            .sheet.padding-7mm {
                padding: 7mm
            }

            .sheet {
                margin: 0;
                width: 100%;
                position: relative;
                box-sizing: border-box;
                page-break-after: always;
            }

            .sheet.padding-7mm {
                padding: 3mm 7mm 7mm 5mm
            }

            .sheet.padding-10mm {
                padding: 3mm 10mm 10mm 5mm
            }

            .sheet.padding-15mm {
                padding: 15mm
            }

            .sheet.padding-20mm {
                padding: 20mm
            }

            .sheet.padding-25mm {
                padding: 25mm
            }

            body.M58 .sheet {
                width: 58mm;
                min-height: 50mm
            }

            body.A14 .sheet {
                width: 210mm;
                height: 74mm
            }

            body.A4 .sheet {
                width: 210mm;
                height: 99mm
            }

            body.F4 .sheet {
                width: 210mm;
                height: 82mm
            }

            .spacer {
                clear: both;
                display: block;
                overflow: hidden;
                visibility: hidden;
                width: 0;
                height: 0;
                font-size: 0px;
                line-height: 0;
            }

            .text-m58 {
                font-family: 'Trebuchet MS';
                font-size: 12px;
                color: #000;
                line-height: 14px;
                overflow-x: hidden;
                display: inline;
                white-space: nowrap;
            }

            .text-m58x {
                font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;
                ;
                font-size: 12px;
                color: #000;
                line-height: 14px;
                overflow-x: hidden;
                display: inline;
                white-space: nowrap;
            }

            .text-all {
                font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;
                ;
                font-size: 12px;
                color: #000;
                line-height: 16px;
                overflow-x: hidden;
                display: inline;

            }

            .text-all2 {
                font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;
                ;
                font-size: 12px;
                color: #646464;
                line-height: 14px;
                overflow-x: hidden;
                display: inline;

            }

            .text-m58-normal {
                font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;
                font-size: 12px;
                color: #000;
                line-height: 14px;
            }

            tbody,
            tr,
            td {
                font-size: 10px;
                line-height: 14px;
                /* font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace; */
                color: #000;
            }
        }

        @media print {
            body.M58 {
                width: 58mm;
                max-width: 58mm;
                min-height: 50mm;
            }

            body.A14 {
                width: 210mm;
                height: 74mm
            }

            body.A4 {
                width: 210mm;
                height: 99mm
            }

            body.F4 {
                width: 210mm;
                height: 82mm
            }

            html.M58 {
                width: 58mm;
                max-width: 58mm;
                min-height: 50mm;
            }

            html.A14 {
                width: 210mm;
                height: 199mm
            }

            html.A4 {
                width: 210mm;
                height: 99mm
            }

            html.F4 {
                width: 210mm;
                height: 82mm
            }

            #header,
            #footer,
            #nav {
                display: none !important;
            }

            html,
            body {
                margin: 2.5mm;
                height: auto;
            }

            .sheet.padding-7mm {
                padding: 5mm 7mm 7mm 5mm
            }

            .sheet.padding-10mm {
                padding: 1mm 2mm 2mm 2mm
            }

            .sheet.padding-15mm {
                padding: 15mm
            }

            .sheet.padding-20mm {
                padding: 20mm
            }

            .sheet.padding-25mm {
                padding: 25mm
            }

            .spacer {
                clear: both;
                display: block;
                overflow: hidden;
                visibility: hidden;
                width: 0;
                height: 0;
                font-size: 0px;
                line-height: 0;
            }

            .text-m58 {
                font-family: 'Trebuchet MS';
                font-size: 12px;
                color: #000;
                line-height: 14px;
                overflow-x: hidden;
                display: inline;
                white-space: nowrap;
            }

            .text-m58x {
                font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;
                ;
                font-size: 12px;
                color: #000;
                line-height: 14px;
                overflow-x: hidden;
                display: inline;
                white-space: nowrap;
            }

            .text-all {
                font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;
                font-size: 12px;

            }

            .text-m58-normal {
                font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;
                font-size: 12px;
                color: #000;
                line-height: 14px;
            }
            
            tbody,
            tr,
            td {
                font-size: 10px;
                line-height: 14px;
                /* font-family: 'Courier New', Courier, 'Trebuchet MS', 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace; */
                color: #000;
            }
        }
    </style>
</head>

<body class="M58">

    <section class="sheet padding-5mm" id="printarea">
        <div class="article">
            <div class="text-m58" style="float: left;font-family:'Trebuchet MS' !important">{{ getTitle() ?? '-' }}
            </div>
            <div class="spacer"></div>
            <div class="text-m58" style="float: left;font-family:'Trebuchet MS' !important">
                {{ now()->format('d/m/Y H:i') }}</div>
            <div class="spacer"></div>
            <div class="text-m58-normal"
                style="width: 100%;text-align: center;margin-top: 10px;margin-bottom: 10px;font-family:'Trebuchet MS' !important">
                <div style="transform: scale(1, 1.2);"><strong>Bukti Pembayaran</strong></div>
            </div>

            <div class="text-m58">
                <p style="font-size: 11px;font-family:'Trebuchet MS' !important;margin-bottom:3px;">Nama :
                    {{ $transaction->donatur->name }}</p>
                <p style="font-size: 11px;font-family:'Trebuchet MS' !important;margin-bottom:3px;">Alamat :
                    {{ $transaction->donatur->address }}</p>
                <p style="font-size: 11px;font-family:'Trebuchet MS' !important;margin-bottom:3px;">Petugas :
                    {{ $transaction->user->name }}</p>
                <p style="font-size: 11px;font-family:'Trebuchet MS' !important;margin-bottom:3px;">Tanggal :
                    {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="spacer"></div>

            <div id="item" style="margin-top:10px;">
                <table style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:left;font-family:'Trebuchet MS' !important;font-size:11px;">No</th>
                            <th style="text-align:left;font-family:'Trebuchet MS' !important;font-size:11px;">Item</th>
                            <th style="text-align:right;font-family:'Trebuchet MS' !important;font-size:11px;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->details as $key => $value)
                            <tr>
                                <td style="font-size: 11px;word-wrap: break-word;font-family:'Trebuchet MS' !important">
                                    {{ $key + 1 }} &nbsp;</td>
                                <td
                                    style="font-size: 11px;;word-wrap: break-word;font-family:'Trebuchet MS' !important">
                                    {{ $value->item->name }}</td>

                                <td
                                    style="font-size: 11px;word-wrap: break-word;font-family:'Trebuchet MS' !important;text-align:right;">
                                    {{ formatRupiah($value->amount) }}</td>
                            </tr>
                        @endforeach
                        <tr style="border-top:1px solid;">
                            <td colspan="2"
                                style="font-size: 11px;;word-wrap: break-word;font-family:'Trebuchet MS' !important">
                                Total</td>

                            <td
                                style="font-size: 11px;word-wrap: break-word;font-family:'Trebuchet MS' !important;text-align:right;">
                                {{ formatRupiah($transaction->total) }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="spacer"></div>
            {{-- <div class="text-m58-normal"
                style="width: 100%;margin-top: 10px;text-align: center;font-size: 10px;font-family:'Trebuchet MS' !important">
                <br>SEGERA LAKUKAN PENGECEKAN<br>PULSA PADA *888# / MY TSEL
            </div> --}}
            <div class="spacer"></div>

        </div>
    </section>
    <div style="margin-left: 10px;margin-top: 20px;"><a href="javascript:void(0);" id="buttonprint"
            class="btn btn-primary w-min-sm mb-0-25 waves-effect waves-light"><i class="fa fa-print"></i> Print
            Data</a>
        <a href="{{ route('transaction.index') }}" class="btn btn-success w-min-sm mb-0-25 waves-effect waves-light"><i
                class="fa fa-arrow-left"></i>
            Kembali</a>
        <div>
            <script type="text/javascript" src="{{ asset('custom/assets/libs/jquery/dist/jquery.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('custom/assets/extensions/print-area/print.area.js') }}"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $("#buttonprint").click(function() {
                        $("#printarea").printArea();
                    });
                });
            </script>


        </div>
    </div>
</body>

</html>
