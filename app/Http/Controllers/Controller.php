<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function show_error_404($object_name = 'Berkas')
    {
      $error_details = array(
        'title' => 'Yaah...',
        'desc' => $object_name . ' yang Anda cari tidak ditemukan.'
      );
      return view('errors.404', $error_details);
    }

    public function show_error_401($object_name = 'Berkas')
    {
      $error_details = array(
        'title' => 'Oops,',
        'desc' => $object_name . ' ini tidak termasuk hak akses Anda.'
      );
      return view('errors.401', $error_details);
    }
}
