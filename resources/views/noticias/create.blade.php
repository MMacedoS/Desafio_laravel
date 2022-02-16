@extends('layouts.app', ['page' => __('Create Noticias'), 'pageSlug' => 'noticias'])

@section('content')
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<style>
        .form-group input[type=file] 
        {
         opacity: 1;
         position: relative;      
        }
        textarea.form-control {                                          
        border: 1px solid #cad1d7;
        border-radius: 0.25rem;
        box-shadow: none;
        transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
</style>
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Criar Notícia') }}</h5>
                </div>
                <form method="post" action="{{ route('noticia.create') }}" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('foto') ? ' has-danger' : '' }}">
                                <label>{{ _('Imagem') }}</label>
                                <input type="file" name="foto" class="form-control-file" id="foto" >
                                @include('alerts.feedback', ['field' => 'foto'])
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label>{{ _('Titulo') }}</label>
                                <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ _('titulo da noticia') }}" >
                                @include('alerts.feedback', ['field' => 'title'])
                            </div>

                            <div class="form-group{{ $errors->has('subtitle') ? ' has-danger' : '' }}">
                                <label>{{ _('SubTitulo') }}</label>
                                <input type="text" name="subtitle" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}" placeholder="{{ _('subtitulo da noticia') }}" >
                                @include('alerts.feedback', ['field' => 'subtitle'])
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <label>{{ _('Descrição') }}</label>                                
                                <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30" rows="10" placeholder="{{ _('description') }}"></textarea>
                                @include('alerts.feedback', ['field' => 'description'])
                            </div>
                            
                            <div class="form-group{{ $errors->has('font') ? ' has-danger' : '' }}">
                                <label>{{ _('Fonte') }}</label>
                                <input type="text" name="font" class="form-control{{ $errors->has('font') ? ' is-invalid' : '' }}" placeholder="{{ _('fonte da noticia') }}" >
                                @include('alerts.feedback', ['field' => 'font'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Save') }}</button>
                    </div>
                </form>
            </div>

           
        </div>
<script>
    CKEDITOR.replace( 'description' );
</script>
@endsection