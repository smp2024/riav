<div  id="carouselExampleIndicators"  class="carousel slide" data-ride="carousel">

    <div id="Image_PC" class="carousel-inner h-100">

        @for($i = 0; $i < sizeof($carrousels); $i++)
            @if($i == 0)
                <div class="carousel-item active h-100">
                    <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$carrousels[$i]->file_path.'/'.$carrousels[$i]->file) }}" alt="First slide">
                    @if($carrousels[$i]->title1 != null)
                        <div class="carousel-caption">
                            <h1 class="display-2">Bootstrap</h1>
                            @if($carrousels[$i]->title2 != null)
                                <h3>Complete WebSite Layout</h3>
                            @endif
                            @if($carrousels[$i]->button1 != null)
                                <button type="button" class="btn btn-outline-light btn-lg ">View Demo</button>
                            @endif
                            @if($carrousels[$i]->button2 != null)
                                <button type="button" class="btn btn-primary btn-lg">Get Started</button>
                            @endif
                        </div>
                    @endif
                </div>
            @else
                <div class="carousel-item h-100">
                    <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$carrousels[$i]->file_path.'/'.$carrousels[$i]->file) }}" alt="First slide">
                    @if($carrousels[$i]->title1 != null)
                        <div class="carousel-caption">
                            <h1 class="display-2">Bootstrap</h1>
                            @if($carrousels[$i]->title2 != null)
                                <h3>Complete WebSite Layout</h3>
                            @endif
                            @if($carrousels[$i]->button1 != null)
                                <button type="button" class="btn btn-outline-light btn-lg ">View Demo</button>
                            @endif
                            @if($carrousels[$i]->button2 != null)
                                <button type="button" class="btn btn-primary btn-lg">Get Started</button>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        @endfor

    </div>

    <div id="Image_Mobile" class="carousel-inner h-100">

        @for($i = 0; $i < sizeof($carrousels); $i++)
            @if($i == 0)
                <div class="carousel-item active h-100">
                    <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$carrousels[$i]->file_path.'/'.$carrousels[$i]->mobil) }}" alt="First slide">
                    @if($carrousels[$i]->title1 != null)
                        <div class="carousel-caption">
                            <h1 class="display-2">Bootstrap</h1>
                            @if($carrousels[$i]->title2 != null)
                                <h3>Complete WebSite Layout</h3>
                            @endif
                            @if($carrousels[$i]->button1 != null)
                                <button type="button" class="btn btn-outline-light btn-lg ">View Demo</button>
                            @endif
                            @if($carrousels[$i]->button2 != null)
                                <button type="button" class="btn btn-primary btn-lg">Get Started</button>
                            @endif
                        </div>
                    @endif
                </div>
            @else
                <div class="carousel-item h-100">
                    <img class="d-block w-100 h-100" src="{{ url('/multimedia'.$carrousels[$i]->file_path.'/'.$carrousels[$i]->file) }}" alt="First slide">
                    @if($carrousels[$i]->title1 != null)
                        <div class="carousel-caption">
                            <h1 class="display-2">Bootstrap</h1>
                            @if($carrousels[$i]->title2 != null)
                                <h3>Complete WebSite Layout</h3>
                            @endif
                            @if($carrousels[$i]->button1 != null)
                                <button type="button" class="btn btn-outline-light btn-lg ">View Demo</button>
                            @endif
                            @if($carrousels[$i]->button2 != null)
                                <button type="button" class="btn btn-primary btn-lg">Get Started</button>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        @endfor

    </div>

</div>
