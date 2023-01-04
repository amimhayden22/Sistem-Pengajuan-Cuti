@extends('layouts.dashboard.app')
@section('title')
Dasbor
@endsection
@section('main-content')
<section class="section">
    <div class="section-header">
        <h1>Dasbor</h1>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="hero bg-primary text-white">
                <div class="hero-inner">
                    <h2>Sistem Informasi Pengajuan Cuti</h2>
                    <p class="lead">
                        Halo <strong style="font-weight: bold !important; text-transform: capitalize !important;">{{ Auth::user()->name }}</strong>, Anda dapat melakukan pengajuan cuti melalui sistem ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role === 'Administrator' || Auth::user()->role === 'HRD')
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Pengajuan Cuti Karyawan per Bulan</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
@endsection
@section('script')
    @if (Auth::user()->role === 'Administrator' || Auth::user()->role === 'HRD')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var monthNames = {!! $monthNames !!};
            var transactions = {!! $getTransactions !!};

            window.onload = function(){
                var ctx = document.getElementById("myChart1").getContext('2d');
                lineChartWindow = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthNames,
                        datasets: [{
                            label: 'Jumlah Karyawan Cuti',
                            data: transactions,
                            borderWidth: 2,
                            backgroundColor: '#3772ff',
                            borderColor: '#3772ff',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#ffffff',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 150
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    display: false
                                },
                                gridLines: {
                                    display: false
                                }
                            }]
                        },
                    }
                });
            }
        </script>
    @endif
@endsection
