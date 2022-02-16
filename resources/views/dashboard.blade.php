@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <h2>Notícias</h2>
    
    <div class="row">
        @foreach($noticias as $noticia)
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Total Shipments</h5>
                    <h2 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> {{ $noticia->title }}</h2>
                </div>
                <div class="card-body">
                    <div class="card-area">
                        <img src="/img/noticia/{{ $noticia->image }}" alt="{{ $noticia->title }}">
                    </div>

                </div>
            </div>
        </div>
       
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $noticias->links() }}
    </div>
    
@endsection

@push('js')
    <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
