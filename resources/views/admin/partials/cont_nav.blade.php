<div class="section-top">
    <div class="logo">
        <a href="/">
            <img src="{{ url('multimedia'.$company[0]->file_path.'/'.$company[0]->file) }}" alt=""  class="img-fluid icon-logo" >
        </a>
    </div>
    <div class="user">

        <div class="name">

            <p> <span class="subtitle">Hola:</span> {{ Auth::user()->name }} {{ Auth::user()->lastname }} </p>

        </div>
        <div class="email">
            <p>{{ Auth::user()->email }}</p>
        </div>
        <div class=" d-flex campaña-content-end align-content-end pr-1 " >
            <a href="{{ url('/logout') }}" data-toggle="tooltip" data-placement="top" title="Cerrar Sesión">
                Salir <i class="fas fa-power-off"></i>
            </a>
        </div>
    </div>
</div>

<div class="main" style="height: 95%; overflow: auto;" >
    <ul>

        @if (kvfj(Auth::user()->permissions, 'dashboard'))
        <li>
            <a href="{{ url('/admin') }}" class="lk-dashboard">
                <i class="fal fa-tachometer-alt-fast"></i>
                Dashboard
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'users_list'))
        <li>
            <a href="{{ url('/admin/users/all') }}" class="lk-users_list lk-user_edit lk-user_permissions">
                <i class="fal fa-users"></i>
                Usuarios
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'company'))
        <li>
            <a href="{{ url('/admin/company') }}" class="lk-company lk-company_add lk-company_edit">
                <i class="fal fa-building"></i>
                Área Corporativa
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'areas'))
        <li>
            <a href="{{ url('/admin/areas') }}" class="lk-areas lk-area_add lk-area_edit">
                <i class="far fa-layer-group"></i>
                Modulos principales
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'articulos'))
        <li>
            <a href="{{ url('/admin/articulos/1') }}" class="lk-articulos lk-articulos_add lk-articulos_edit">
                <i class="fal fa-newspaper"></i>
                Artículos
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'campañas'))
        <li>
            <a href="{{ url('/admin/campañas/1/') }}" class="lk-campaña lk-campaña_add lk-campaña_edit">
                <i class="fal fa-building"></i>
                Campaña
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'exhibiciones'))
        <li>
            <a href="{{ url('/admin/exhibiciones/1') }}" class="lk-exhibiciones lk-exhibiciones_add lk-exhibiciones_edit">
                <i class="fal fa-camera-polaroid"></i>
                Exhibiciones
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'comunidad'))
        <li>
            <a href="{{ url('/admin/communities/1') }}" class="lk-comunidad lk-comunidad_add lk-comunidad_edit">
                <i class="fal fa-users-class"></i>
                Comunidad
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'reciclaje'))
        <li>
            <a href="{{ url('/admin/reciclaje') }}" class="lk-reciclaje lk-reciclaje_add lk-reciclaje_edit">
                <i class="fad fa-recycle"></i>
                Reciclaje
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'carousels'))
        <li>
            <a href="{{ url('/admin/carousels') }}" class="lk-carousels lk-carousel_add lk-carousel_edit">
                <i class="far fa-object-group"></i>
                Imagen de inicio
            </a>
        </li>
        @endif

        @if (kvfj(Auth::user()->permissions, 'video'))
        <li>
            <a href="{{ url('/admin/video') }}" class="lk-video lk-video_add lk-video_edit">
                <i class="fal fa-play-circle"></i>
                Video
            </a>
        </li>
        @endif
        @if (kvfj(Auth::user()->permissions, 'gallery'))
        <li>
            <a href="{{ url('/admin/gallery') }}" class="lk-gallery lk-gallery_add lk-gallery_edit">
                <i class="fal fa-photo-video"></i>
                Galeria
            </a>
        </li>
        @endif




    </ul>
</div>
