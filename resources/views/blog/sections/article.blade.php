
@extends('master')

@section('title',  $post->name )

@section('content')
    <div  class="col-12">
        <div class="row " >

            <!-- TITULO NOTICIA -->
            <div class="col-12 justify-content-center align-items-center Height5_2" >

                <h3 style="text-align: center;">{!!  html_entity_decode($post->name, ENT_QUOTES | ENT_XML1, 'UTF-8')  !!}</h3>

            </div>
        <!-- iMAGEN DESTACADA -->
            <div  class="col-12 justify-content-center align-items-center Height70" style="padding: 0 20%; margin-bottom: 40px;">
                <img src="{{ url('/multimedia/'.$post->file_path.'/'.$post->slug.'/'.$post->file) }}" class="d-block imagen_noticia w-100 h-100" alt="...">

            </div>

            <!-- Secccion-->
                @for ($i=1 ; $i<=$post->sections; $i++)
                    <!-- DESCRIPCION -->
                        <div  class="col-12 justify-content-center align-items-center text-justify " style="margin-bottom: 25px;  height: auto;  padding: 5px 10%; ">

                            @foreach ($descriptions as $description)
                                @if ($description->section == $i-1)
                                    {!! html_entity_decode($description->content, ENT_QUOTES | ENT_XML1, 'UTF-8') !!}
                                @endif
                            @endforeach

                        </div>
                    <!-- IMAGENES   -->

                        <div  class="col-12 d-flex justify-content-center align-items-center " style="padding: 0; margin-bottom: 25px;  height: auto;">
                            <div id="carouselExampleControls_{{$i}}" class="carousel slide h-100 w-100" data-ride="carousel">
                                <div class="carousel-inner h-100">
                                    @foreach ($imagenes as $imagen)
                                        @if($i == $imagen->after)
                                            <div class="carousel-item active h-100">
                                                <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$imagen->file_path.'/'.$imagen->file_name) }}" alt="">
                                            </div>
                                        @else
                                            <div class="carousel-item  h-100">
                                                <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$imagen->file_path.'/'.$imagen->file_name) }}" alt="">
                                            </div>
                                        @endif
                                    @endforeach


                                </div>
                                <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev" style="border: none;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next" style="border: none;">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </button>
                            </div>
                        </div>

                    <!--VIDEO -->
                        @if ($post->video_1 != null )
                            <div  class="col-12 justify-content-center align-items-center vimeo" style="padding: 0; height:50%; min-height:300px; margin-bottom: 25px;">

                                {!! html_entity_decode($post->video_1, ENT_QUOTES | ENT_XML1, 'UTF-8') !!}

                            </div>
                        @endif

                @endfor



        </div>
    </div>
@endsection
@section('scripts')
@endsection
