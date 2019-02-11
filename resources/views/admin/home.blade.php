@extends('layouts.master')

@section('content')
<div class="row grid-responsive">
    <div class="column column-33">
        <div class="card">
            <a href="{{ route('barang.index') }}">
            <div class="card-title">
                <h2>Data Barang
                    <div class="pull-right"><em class="fa fa-arrow-right"></em></div>
                </h2>
            </div>
            </a>
            <div class="card-block">
                <div class="canvas-wrapper">
                    <center><h1><em class="fa fa-cubes"></em> {{ $barang }}</h1></center>
                </div>
            </div>
        </div>
    </div>
    <div class="column column-33">
        <div class="card">
            <a href="{{ route('supplier.index') }}">
            <div class="card-title">
                <h2>Data Supplier
                    <div class="pull-right"><em class="fa fa-arrow-right"></em></div>
                </h2>
            </div>
            </a>
            <div class="card-block">
                <div class="canvas-wrapper">
                    <center><h1><em class="fa fa-industry"></em> {{ $supplier }}</h1></center>
                </div>
            </div>
        </div>
    </div>
    <div class="column column-33">
        <div class="card">
            <a href="{{ route('user.index') }}">
            <div class="card-title">
                <h2>Data User
                    <div class="pull-right"><em class="fa fa-arrow-right"></em></div>
                </h2>
            </div>
            </a>
            <div class="card-block">
                <div class="canvas-wrapper">
                    <center><h1><em class="fa fa-user"></em> {{ $user }}</h1></center>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row grid-responsive">
    <div class="column">
        <div class="card">
            <div class="card-title">
                <center><h2>Grafik Penjualan {{ tanggal_indonesia($awal,false) }} s/d {{ tanggal_indonesia($akhir,false) }}</h2></center>
           </div>
            <div class="card-block">
                <div class="canvas-wrapper">
                    <canvas class="chart" id="line-chart" height="auto" width="auto"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<p class="credit">HTML5 Admin Template by <a href="#">Medialoot</a> And Edited by <a href="">M Irfan Permana @2018</a></p>
@endsection

@section('script')
    <script type="text/javascript">    
            var lineChartData = {
                labels : {{ json_encode($data_tanggal) }},
                datasets : [
                    {
                        label: "My Second dataset",
                        fillColor : "rgba(37, 190, 174, 0.2)",
                        strokeColor : "rgba(37, 190, 174, 1)",
                        pointColor : "rgba(37, 190, 174, 1)",
                        pointStrokeColor : "#fff",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(37, 190, 174, 1)",
                        data : {{ json_encode($data_pendapatan) }}
                    }
                ]

            }

            window.onload = function () {
                var chart1 = document.getElementById("line-chart").getContext("2d");
                
                window.myLine = new Chart(chart1).Line(lineChartData, {
                    responsive: true,
                    scaleLineColor: "rgba(0,0,0,.2)",
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    scaleFontColor: "#c5c7cc"
                });
            }
        // });
    </script>
@endsection