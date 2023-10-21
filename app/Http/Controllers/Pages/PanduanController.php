<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function index(Request $request)
    {
        $sideMenu = $this->getSideMenuList($request);
        return view('pages.panduan', [
            'sideMenu' => $sideMenu
        ]);
    }
}
