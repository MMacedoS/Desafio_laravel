@extends('layouts.app', ['page' => __('Create Noticias'), 'pageSlug' => 'noticias'])

@section('content')
    <style>
       section.description {
            margin-top: 5rem;
            text-indent: 40px;
        }
    </style>
        
    <section class="title">
        <div class="text-center title">
            <h1>{{ $noticia->title }}</h1>
        </div> 
 
        <div class="text-center subtitle">
            <p>{{ $noticia->subtitle }}</p>
        </div> 

        <div class="img mb-3" >
            <img src="/img/noticia/{{ $noticia->image }}" alt="{{ $noticia->title }}" style="height:400px; width:100%">    
        </div>     
        <div class="font float-right mb-4">
            <p>Fonte: <b>{{ $noticia->font }}</b></p>
        </div>      
    </section>  

    <section class="description">
        <div class="text-justify mt-3">
             {!! $noticia->description !!}
        </div>

        <div class="autor mt-4 float-right">
            <p>Autor: <b>{{ $autor['name'] }}</b></p>
        </div>    
    </section>

    



@endsection