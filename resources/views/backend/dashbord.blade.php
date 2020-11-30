@extends('backend.master')

@section('content')
    <h4 class="header-title mb-4">Charts Overview</h4>
    <h6 class="header-title mb-4 text-center">User Ragistation date using High chart</h6>
    {!! $chart->container() !!}
    <br>
    <br>
    <br>
    <h6 class="header-title mb-4 text-center">Sale date using Fasion chart</h6>
    {!! $chart2->container() !!}

@endsection

@section('footer_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    {!! $chart2->script() !!}
@endsection
