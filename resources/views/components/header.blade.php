<div class="header">
  <div class="header-content">
    <nav class="navbar navbar-expand">
      <div class="collapse navbar-collapse justify-content-between">
        <div class="header-left">
          <div class="dashboard_bar">
            <div class="input-group search-area d-lg-inline-flex d-none">
              <div class="input-group-append">
                <button class="input-group-text search_icon search_icon"><i class="flaticon-381-search-2"></i></button>
              </div>
              <input type="text" class="form-control" placeholder="Search here...">
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
          <li class="nav-item dropdown notification_dropdown">
            <a class="nav-link bell bell-link" href="javascript:void(0)">
              <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M25.6666 8.16666C25.6666 5.5895 23.5771 3.5 21 3.5C17.1161 3.5 10.8838 3.5 6.99998 3.5C4.42281 3.5 2.33331 5.5895 2.33331 8.16666V23.3333C2.33331 23.8058 2.61798 24.2305 3.05315 24.4113C3.48948 24.5922 3.99115 24.4918 4.32481 24.1582C4.32481 24.1582 6.59281 21.8902 7.96714 20.517C8.40464 20.0795 8.99733 19.8333 9.61683 19.8333H21C23.5771 19.8333 25.6666 17.7438 25.6666 15.1667V8.16666ZM23.3333 8.16666C23.3333 6.87866 22.2891 5.83333 21 5.83333C17.1161 5.83333 10.8838 5.83333 6.99998 5.83333C5.71198 5.83333 4.66665 6.87866 4.66665 8.16666V20.517L6.31631 18.8673C7.19132 17.9923 8.37899 17.5 9.61683 17.5H21C22.2891 17.5 23.3333 16.4558 23.3333 15.1667V8.16666ZM8.16665 15.1667H17.5C18.144 15.1667 18.6666 14.644 18.6666 14C18.6666 13.356 18.144 12.8333 17.5 12.8333H8.16665C7.52265 12.8333 6.99998 13.356 6.99998 14C6.99998 14.644 7.52265 15.1667 8.16665 15.1667ZM8.16665 10.5H19.8333C20.4773 10.5 21 9.97733 21 9.33333C21 8.68933 20.4773 8.16666 19.8333 8.16666H8.16665C7.52265 8.16666 6.99998 8.68933 6.99998 9.33333C6.99998 9.97733 7.52265 10.5 8.16665 10.5Z"
                  fill="#3E4954" />
              </svg>
              <span class="badge light text-white bg-primary rounded-circle">5</span>
            </a>
          </li>
          <li class="nav-item dropdown header-profile">
            <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
              <div class="header-info">
                <span class="text-black"><strong>@formatNama(Auth::user()->nama_lengkap)</strong></span>
                <p class="fs-12 mb-0">@cptl(Auth::user()->getRoleNames()->first())</p>
              </div>
              <div class="profile-initials"
                style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                      background-color: {{ '#' . substr(md5(Auth::user()->nama_lengkap), 0, 6) }}; color: white; font-weight: bold; font-size: 25px;">
                @php
                  $nama = explode(' ', Auth::user()->nama_lengkap);
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
