<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://report.orderkuota.com/public/struk/css/normalize.css">
    <style>
        @page {
            size: 58mm;
            margin: 0;
        }
        body {
            font-family: monospace;
            font-size: 9px;
            width: 58mm;
            max-width: 58mm;
            margin: 0;
            padding: 5px;
            text-align: center;
            overflow: hidden;
        }

        .header {
            border-bottom: 1px dashed black;
            padding-bottom: 5px;
        }

        .transaction-details {
            text-align: left;
        }

        .total {
            font-weight: bold;
            border-top: 1px dashed black;
            padding-top: 5px;
        }

        .footer {
            font-size: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div id="printarea">


        <div class="header">
            <h3>NAMA ORGANISASI</h3>
            <p>Alamat Lengkap<br>Telp: Nomor Telepon</p>
        </div>

        <div class="transaction-details">
            <p>No. Kwitansi: [NOMOR KWITANSI]</p>
            <p>Tanggal: [TANGGAL]</p>
            <p>Nama: [NAMA PEMBAYAR]</p>
        </div>

        <table style="width:100%">
            <thead>
                <tr>
                    <th style="text-align:left">Item</th>
                    <th style="text-align:right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>[NAMA ITEM 1]</td>
                    <td style="text-align:right">Rp. [HARGA 1]</td>
                </tr>
                <tr>
                    <td>[NAMA ITEM 2]</td>
                    <td style="text-align:right">Rp. [HARGA 2]</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <p style="display:flex; justify-content:space-between;">
                <span>Total:</span>
                <span>Rp. [TOTAL HARGA]</span>
            </p>
        </div>

        <div class="footer">
            <p>Terima Kasih</p>
            <p>Kwitansi ini sah tanpa tanda tangan</p>
        </div>
    </div>
    <div style="margin-left: 10px;margin-top: 20px;"><a href="javascript:void(0);" id="buttonprint"
            class="btn btn-primary w-min-sm mb-0-25 waves-effect waves-light"><i class="ti-printer"></i> Print Data</a>
        <script type="text/javascript" src="https://report.orderkuota.com/public/struk/js/jquery-1.12.3.min.js"></script>
        <script type="text/javascript" src="https://report.orderkuota.com/public/struk/js/print.area.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#buttonprint").click(function() {
                    $("#printarea").printArea();
                });
            });
        </script>
</body>

</html>
