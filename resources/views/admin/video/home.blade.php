@extends('admin.master')
@section('title', 'Galería')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kits') }}">
            <i class="fal fa-photo-video"></i>
            Video
        </a>
    </li>

@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="container" style="    display: flex;    justify-content: center;">
                <div class="video-wrap" style="max-width: 250px !important;">
                    <div class="video w-100">
                      {!! html_entity_decode($cats_->description, ENT_QUOTES | ENT_XML1, 'UTF-8') !!}
                    </div>
                </div>
            </div>
            @if ($video == 0)
                <div class="col-md-12 mt-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fal fa-file-edit"></i>
                                Editar descripción
                            </h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/video/add']) !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            {{ Form::label('description','Descripcion:') }}
                                            <div class="input-group-prepend">
                                                {!! Form::textarea('description', null, ['class' => 'form-control ', 'id' => 'editor', 'rows' => '1']) !!}

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {!! Form::submit('Actualizar Video', ['class' => 'btn btn-success mt16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-12 mt-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fal fa-file-edit"></i>
                                Editar descripción
                            </h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/video/'.$cats_->id.'/edit']) !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            {{ Form::label('description','Descripcion:') }}
                                            <div class="input-group-prepend">
                                                {!! Form::textarea('description', $cats_->description, ['class' => 'form-control ', 'id' => 'editor','rows' => '5']) !!}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {!! Form::submit('Actualizar Video', ['class' => 'btn btn-success mt16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endif


        </div>

    </div>

@stop

