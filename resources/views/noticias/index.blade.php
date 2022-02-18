@extends('layouts.app', ['page' => __('Noticia Management'), 'pageSlug' => 'noticias'])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2">
                                <h4 class="card-title">Notícias</h4>
                                
                            </div>
                            <DIV class="col-4">
                                <form action="{{ route('noticia.index') }}" method="get">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="digite sua consulta e pressione enter">
                                </form>
                            </DIV>
                            <div class="col-4 text-right">
                                <a href="{{ route('noticia.add') }}" class="btn btn-sn btn-primary">Add Noticias</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                        @include('alerts.success')

                        @if(count($allNoticias)==0)
                                      {{  __('Não possui noticias cadastradas') }}
                         @else
                              
                            <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Subtitle</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                    @foreach($allNoticias as $noticia)
                                        <tr>
                                            <td>{{ $noticia->title }}</td>
                                            <td>
                                                {{ substr($noticia->subtitle,0,60) }}
                                            </td>
                                            <td class="text-right">
                                                {{ date('d/m/Y H:i:s', strtotime($noticia->created_at)) }}
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                            
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item bg-info" style="border-radius:5px;" href="/noticias/edit/{{ $noticia->id }}">Edit</a>
                                                                                                       
                                                        <form action="/noticia/{{ $noticia->id }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item bg-warning" style="border-radius:5px;" href="/noticia/{{ $noticia->id }}">Delete</button>                        
                                                        </form> 
                                                    </div>
                                                   
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          
                        @endif
                        </div>
                    </div>
                    <div class="card-footer py-4">
                            
                            <nav class="d-flex justify-content-end" aria-label="..."></nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection