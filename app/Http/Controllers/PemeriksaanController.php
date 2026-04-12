<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function service() {
        return $this->belongsTo(Service::class, 'id');
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'id');
}
}