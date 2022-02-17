@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <h2>Notícias</h2>
    
    <div class="row">
        @if(count($noticias)>0)
           @foreach($noticias as $noticia)
                <div class="col-lg-4" onclick="noticia('{{ $noticia->id }}')">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h2 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> {{ $noticia->title }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="card-area">
                                <img src="/img/noticia/{{ $noticia->image }}" alt="{{ $noticia->title }}">
                            </div> 
                        </div>     
                        <div class="card-footer my-0">
                                {{ $noticia->subtitle }}     
                        </div>             
                    </div>
                </div>
           
            @endforeach
        @else
          <div class="col-sm-12 {{ $class ?? '' }}">
                Você não possui noticia cadastrada!
                
          </div>
          <a href="{{ route('noticia.add') }}" class="btn btn-secodary mt-2 ml-3">Cadastrar</a>
          
        @endif
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

    <script>
        function noticia(noticia)
        {
           window.location.href = "/noticia/"+noticia;
        }
    </script>

<script type="text/javascript">
    $('#btnBusca').keyup(function()
    {
        if($('#btnBusca').val().length >= 3)
        {
           $('#lista').html('buscando...');

           $.ajax({
               url:"{{ route('pesquisar') }}",
               method:'get',
               datatype:'json',
               data:{data:$('#btnBusca').val()},
               success:function(data){
                    lista(data);
               }
           });
        }
    });

    function lista(data)
    {
        var html="";
       
        data.forEach(element => {
            html+='<div class="col-sm-12" onclick="noticia('+element.id+')">';
            html+='<div class="card card-chart">';
            html+='<div class="card-header">';
            html+='<h2 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> '+element.title+'</h2>';
            html+='</div>';
            html+=' <div class="card-body">';
            html+='<img src="/img/noticia/'+element.image+'" alt="'+element.title+'">';
            html+='</div>';
            html+='</div>';
            html+='<div class="card-footer my-0">';
            html+= element.subtitle;
            html+='</div>';

            html+='</div>';
            html+='</div>';            
        });
        
        $('#lista').html(html);    
    }
</script>
@endpush
