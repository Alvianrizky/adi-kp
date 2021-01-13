<li class="nav-item {{ request()->is('admin/home') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('admin.home')}}">
    <i class="fas fa-fw fa-home"></i>
    <span>Home</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
  Features
</div>
<li class="nav-item {{ request()->is('admin/guru*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('guru.index')}}">
    <i class="fa fa-users"></i>
    <span>Guru</span>
  </a>
</li>
<li class="nav-item {{ request()->is('admin/siswa*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('siswa.index')}}">
    <i class="fa fa-users"></i>
    <span>Siswa</span>
  </a>
</li>
<li class="nav-item {{ request()->is('admin/absen/siswa*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('admin.absen.siswa.index')}}">
    <i class="fas fa-clipboard-list"></i>
    <span>Absensi Siswa</span>
  </a>
</li>
<li class="nav-item {{ request()->is('admin/absen/guru*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('admin.absen.guru.index')}}">
    <i class="fas fa-clipboard-list"></i>
    <span>Absensi Guru</span>
  </a>
</li>
<li class="nav-item {{ request()->is('admin/spp*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('spp.index')}}">
    <i class="fas fa-file-invoice"></i>
    <span>Pembayaran SPP</span>
  </a>
</li>
<li class="nav-item {{ request()->is('admin/laporan/spp*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('admin.laporan.home')}}">
    <i class="fas fa-poll-h"></i>
    <span>Laporan SPP</span>
  </a>
</li>
<li class="nav-item {{ request()->is('admin/kegiatan*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('kegiatan.index')}}">
    <i class="fas fa-map"></i>
    <span>Kegiatan</span>
  </a>
</li>
<li class="nav-item {{ request()->is('admin/monitoring/siswa*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('admin.monitoring.index')}}">
    <i class="fas fa-desktop"></i>
    <span>Monitoring Siswa</span>
  </a>
</li>
<hr class="sidebar-divider">
<li class="nav-item {{ request()->is('admin/database*') ? 'active' : '' }}">
  <a class="nav-link" href="{{route('admin.database.index')}}">
    <i class="fas fa-database"></i>
    <span>Database</span>
  </a>
</li>