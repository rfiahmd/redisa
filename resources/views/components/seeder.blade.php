<div class="deznav">
  <div class="deznav-scroll">
    <ul class="metismenu" id="menu">
      <li class="px-4 py-2 mt-2 mb-2">
        <h4 class="fw-bold nav-text">Home</h4>
      </li>
      <li>
        <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}" aria-expanded="false">
          <i class="flaticon-381-networking"></i>
          <span class="nav-text">Dashboard</span>
        </a>
      </li>
      <li class="px-4 pt-4 mt-4 border-top border-primary">
        <h4 class="fw-bold nav-text">Master</h4>
      </li>
      <li>
        <a href="{{ route('data.verifikator') }}" aria-expanded="false">
          <i class="la la-user-check" style="font-size: 24px;"></i>
          <span class="nav-text">Operator</span>
        </a>
      </li>
      <li>
        <a href="{{ route('customer_service') }}" aria-expanded="false">
          <i class="la la-user-check" style="font-size: 24px;"></i>
          <span class="nav-text">Suctomer Service</span>
        </a>
      </li>
      <li>
        <a href="#" aria-expanded="false">
          <i class="la la-user-tie" style="font-size: 24px;"></i>
          <span class="nav-text">Petugas Desa</span>
        </a>
      </li>
      <li>
        <a href="{{ route('jenis_disabilitas') }}" aria-expanded="false">
          <i class="la la-wheelchair" style="font-size: 24px;"></i>
          <span class="nav-text">Jenis Disabilitas</span>
        </a>
      </li>
      <li>
        <a href="#" aria-expanded="false">
          <i class="la la-map-marker" style="font-size: 24px;"></i>
          <span class="nav-text">Data Desa</span>
        </a>
      </li>
      <li class="px-4 pt-4 mt-4 border-top border-primary">
        <h4 class="fw-bold nav-text">Operasional</h4>
      </li>
      <li>
        <a href="{{ route('disabilitas') }}" aria-expanded="false">
          <i class="la la-users" style="font-size: 24px;"></i>
          <span class="nav-text">Data Disabilitas</span>
        </a>
      </li>
      <li>
        <a href="{{ route('bantuan_disabilitas') }}" aria-expanded="false">
          <i class="la la-hand-holding-heart" style="font-size: 24px;"></i>
          <span class="nav-text">Bantuan</span>
        </a>
      </li>
      <li>
        <a href="#" aria-expanded="false">
          <i class="la la-check-circle" style="font-size: 24px;"></i>
          <span class="nav-text">Verifikasi Data</span>
        </a>
      </li>
      <li>
        <a href="#" aria-expanded="false">
          <i class="la la-chart-bar" style="font-size: 24px;"></i>
          <span class="nav-text">Laporan</span>
        </a>
      </li>
    </ul>

    <div class="copyright">
      <p>© 2025 All Rights Reserved</p>
      <p>Made with <span class="heart"></span> by TurboMain</p>
    </div>
  </div>
</div>
