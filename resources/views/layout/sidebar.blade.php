<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Football<span>Apps</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['admin/home']) }}">
        <a href="{{ url('admin/home') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/season']) }}">
        <a href="{{ url('admin/season') }}" class="nav-link">
          <i class="link-icon" data-feather="codepen"></i>
          <span class="link-title">Musim</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/club']) }}">
        <a href="{{ url('admin/club') }}" class="nav-link">
          <i class="link-icon" data-feather="shield"></i>
          <span class="link-title">Klub</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/schedule']) }}">
        <a href="{{ url('admin/schedule') }}" class="nav-link">
          <i class="link-icon" data-feather="clock"></i>
          <span class="link-title">Jadwal Pertandingan</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/post']) }}">
        <a href="{{ url('admin/post') }}" class="nav-link">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Post</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/category']) }}">
        <a href="{{ url('admin/category') }}" class="nav-link">
          <i class="link-icon" data-feather="folder"></i>
          <span class="link-title">Kategori Post</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/user']) }}" @if (Auth::user()->role=='author')style="display:none;" @endif>
        <a href="{{ url('admin/user') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">User</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
