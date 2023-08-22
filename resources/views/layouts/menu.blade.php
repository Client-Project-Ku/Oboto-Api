<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('places') }}" class="nav-link {{ Request::is('places') ? 'active' : '' }}">
        <i class="nav-icon fas fa-map"></i>
        <p>Input Tempat</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('images') }}" class="nav-link {{ Request::is('images') ? 'active' : '' }}">
        <i class="nav-icon fas fa-map"></i>
        <p>Input Gambar</p>
    </a>
</li>
