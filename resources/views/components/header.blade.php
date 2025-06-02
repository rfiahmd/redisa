<div class="header">
  <div class="header-content">
    <nav class="navbar navbar-expand">
      <div class="collapse navbar-collapse justify-content-between">
        <div class="header-left">
          <div class="dashboard_bar">
            <div class="input-group search-area d-lg-inline-flex d-none">
              {{-- <div class="input-group-append">
                <button class="input-group-text search_icon search_icon"><i class="flaticon-381-search-2"></i></button>
              </div> --}}
              {{-- <input type="text" class="form-control" placeholder="Search here..."> --}}
            </div>
          </div>
        </div>
        <ul class="navbar-nav header-right">
          <li class="nav-item">
            <div class="d-flex weather-detail">
              <span id="time-icon"></span>
              <h3 id="date-text" style="margin-top: 9px"></h3>
            </div>
          </li>
          <li class="nav-item dropdown notification_dropdown">
            <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
              <i id="icon-light" class="fas fa-sun"></i>
              <i id="icon-dark" class="fas fa-moon"></i>
            </a>
          </li>
          <li class="nav-item dropdown header-profile">
            <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
              <div class="header-info">
                <span class="text-black">
                  <strong>@formatNama(preg_replace('/[^a-zA-Z0-9. ]/', '', Auth::user()->nama_lengkap))</strong>
                </span>
                <p class="fs-12 mb-0">@cptl(Auth::user()->getRoleNames()->first())</p>
              </div>
              <div class="profile-initials"
                style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                        background-color: {{ '#' . substr(md5(preg_replace('/[^a-zA-Z0-9. ]/', '', Auth::user()->nama_lengkap)), 0, 6) }}; 
                        color: white; font-weight: bold; font-size: 25px;">
                @php
                  $nama_bersih = preg_replace('/[^a-zA-Z0-9. ]/', '', Auth::user()->nama_lengkap);
                  $nama = explode(' ', $nama_bersih);
                  $initials = strtoupper(substr($nama[0], 0, 1));
                  if (count($nama) > 1) {
                      $initials .= strtoupper(substr($nama[1], 0, 1));
                  }
                @endphp
                {{ $initials }}
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <a href="{{ route('profil.index') }}" class="dropdown-item ai-icon">
                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                  height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span class="ms-2">Profile</span>
              </a>
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="dropdown-item ai-icon">
                  <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                  </svg>
                  <span class="ms-2">Logout</span>
                </button>
              </form>
            </div>
          </li>

        </ul>
      </div>
    </nav>
  </div>
</div>
