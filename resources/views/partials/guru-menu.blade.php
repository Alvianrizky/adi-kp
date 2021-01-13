<li class="nav-item {{ request()->is('guru/home') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('guru.home')}}">
    <i class="fas fa-fw fa-home"></i>
    <span>Home</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
  Features
</div>
<li class="nav-item {{ request()->is('guru/siswa*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('guru.siswa.index')}}">
    <i class="fa fa-users"></i>
    <span>Siswa</span>
  </a>
</li>
<li class="nav-item {{ request()->is('guru/absen/siswa*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('guru.absen.siswa.index')}}">
    <i class="fas fa-clipboard-list"></i>
    <span>Absensi Siswa</span>
  </a>
</li>
<li class="nav-item {{ request()->is('guru/spp*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('guru.spp.index')}}">
    <i class="fas fa-file-invoice"></i>
    <span>Pembayaran SPP</span>
  </a>
</li>
<li class="nav-item {{ request()->is('guru/kegiatan*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('guru.kegiatan.index')}}">
    <i class="fas fa-map"></i>
    <span>Kegiatan</span>
  </a>
</li>
<li class="nav-item {{ request()->is('guru/monitoring/siswa*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('guru.monitoring.index')}}">
    <i class="fas fa-desktop"></i>
    <span>Monitoring Siswa</span>
  </a>
</li>
