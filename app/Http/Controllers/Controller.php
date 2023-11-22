<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SideMenuController;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getSideMenuList(Request $request)
    {
        $sideMenu = new SideMenuController();
        return $sideMenu->sideMenuList($request);
    }

    public function formatDateDatabase(String $date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }

    public function formatDateUI($date)
    {
        return Carbon::parse($date)->format('d M Y');
    }
}
