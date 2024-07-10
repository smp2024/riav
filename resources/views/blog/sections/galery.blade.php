<div id="" class="col-12 ">
    <div class="row mb-2 justify-content-center align-content-center" style="height: 10%;">
       <h1> GALERÍA</h1>
    </div>
    <div class="row  justify-content-center align-content-center Pgallery" style="height: 30%;">
        <p>{!!  html_entity_decode($galleryInfo->description	, ENT_QUOTES | ENT_XML1, 'UTF-8')  !!}</p>
     </div>
     <div class="row ContenedorGallery justify-content-center align-content-center" >
        <div id="carouselExampleControls" class="carousel slide h-100 w-100" data-ride="carousel">
            <div class="carousel-inner h-100">
                @for($i = 0; $i < sizeof($galleries); $i++)
                    @if($i == 0)
                        <div class="carousel-item active h-100">
                            <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$galleries[$i]->file_path.'/'.$galleries[$i]->file) }}" alt="">
                        </div>
                    @else
                        <div class="carousel-item  h-100">
                            <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$galleries[$i]->file_path.'/'.$galleries[$i]->file) }}" alt="">
                        </div>
                    @endif
                @endfor
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
</div>
