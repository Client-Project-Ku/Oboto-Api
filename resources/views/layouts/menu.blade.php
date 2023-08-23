<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('place.create') }}" class="nav-link {{ Request::is('place/create') ? 'active' : '' }}">
        <i class="nav-icon fas fa-map"></i>
        <p>Input Tempat</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('image.create') }}" class="nav-link {{ Request::is('image/create') ? 'active' : '' }}">
        <i class="nav-icon fas fa-image"></i>
        <p>Input Gambar</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('image.create') }}" class="nav-link {{ Request::is('image') ? 'active' : '' }}">
        <i class="nav-icon fas fa-map"></i>
        <p>Input Fasilitas</p>
    </a>
</li>
