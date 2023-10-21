<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SideMenuController extends Controller
{
    public function sideMenuList(Request $request)
    {
        $activeMenu = $this->currentActiveMenu($request);
        return [
            'side_menu' => $this->listPage(),
            'active_first_menu' => $activeMenu['active_first_menu'],
            'active_second_menu' => $activeMenu['active_second_menu'],
        ];
    }

    public function currentActiveMenu(Request $request)
    {
        $firstPageName = '';
        $secondPageName = '';

        $routeName = $request->route()->getName();
        $sideBar = $this->listPage();

        foreach ($sideBar as $menu) {
            if ($menu['route_name'] == $routeName && empty($firstPageName)) {
                $firstPageName = $menu['route_name'];
            }

            // Have Sub_menu
            if (isset($menu['sub_menu'])) {
                foreach ($menu['sub_menu'] as $subMenu) {
                    if ($subMenu['route_name'] == $routeName && empty($secondPageName) && $subMenu['route_name'] != 'dashboard') {
                        $firstPageName = $menu['route_name'];
                        $secondPageName = $subMenu['route_name'];
                    }
                }
            }
        }

        return [
            'active_first_menu' => $firstPageName,
            'active_second_menu' => $secondPageName
        ];
    }

    public function listPage()
    {
        // Icon -> font awesome class
        return [
            'dashboard' => [
                'icon' => 'fa-solid fa-house',
                'route_name' => 'dashboard',
                'title' => 'Dashboard'
            ],
            'lahan' => [
                'icon' => 'fa-solid fa-map-pin',
                'route_name' => 'lahan.index',
                'title' => 'Lahan'
            ],
            'tanaman' => [
                'icon' => 'fa-brands fa-pagelines',
                'route_name' => 'tanaman',
                'title' => 'Tanaman',
                'sub_menu' => [
                    'daftar-tanaman' => [
                        'icon' => 'fa-solid fa-list',
                        'route_name' => 'tanaman.index',
                        'title' => 'Daftar Tanaman'
                    ],
                    'tambah-tanaman' => [
                        'icon' => 'fa-solid fa-plus',
                        'route_name' => 'tanaman.create',
                        'title' => 'Tambah Tanaman'
                    ],
                ]
            ],
            'rekomendasi' => [
                'icon' => 'fa-solid fa-hands-holding-circle',
                'route_name' => 'rekomendasi',
                'title' => 'Rekomendasi',
                'sub_menu' => [
                    'pengairan' => [
                        'icon' => 'fa-solid fa-droplet',
                        'route_name' => 'rekomendasi.pengairan',
                        'title' => 'Pengairan'
                    ],
                    'pemupukan' => [
                        'icon' => 'fa-solid fa-seedling',
                        'route_name' => 'rekomendasi.pemupukan',
                        'title' => 'Pemupukan'
                    ]
                ]
            ],
            'riwayat' => [
                'icon' => 'fa-solid fa-clock-rotate-left',
                'route_name' => 'riwayat',
                'title' => 'Riwayat',
                'sub_menu' => [
                    'tinggi-tanaman' => [
                        'icon' => 'fa-solid fa-plant-wilt',
                        'route_name' => 'riwayat.tanaman.tinggi',
                        'title' => 'Tinggi Tanaman'
                    ],
                    'rekomendasi' => [
                        'icon' => 'fa-solid fa-hand-holding-heart',
                        'route_name' => 'riwayat.rekomendasi',
                        'title' => 'Rekomendasi'
                    ],
                ]
            ],
            'panduan' => [
                'icon' => 'fa-solid fa-book',
                'route_name' => 'panduan',
                'title' => 'Panduan',
            ],
        ];
    }
}
