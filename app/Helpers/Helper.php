<?php

use Illuminate\Support\Facades\Auth;
use App\Models\VerifikatorDesa;

if (!function_exists('get_desa_verifikator')) {
  function get_desa_verifikator()
  {
    return VerifikatorDesa::where('user_id', Auth::id())
      ->with('desa')
      ->get();
  }
}
