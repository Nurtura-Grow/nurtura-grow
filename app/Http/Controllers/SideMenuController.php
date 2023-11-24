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
            ...$activeMenu
        ];
    }

    public function currentActiveMenu(Request $request)
    {
        $firstMenu = '';
        $secondMenu = '';
        $firstPage = '';
        $secondPage = '';

        $routeName = $request->route()->getName();
        $sideBar = $this->listPage();

        foreach ($sideBar as $menu) {
            if ($menu['route_name'] == $routeName && empty($firstMenu)) {
                $firstMenu = $menu['route_name'];
                $firstPage = $menu['title'];
            }

            // Have Sub_menu
            if (isset($menu['sub_menu'])) {
                foreach ($menu['sub_menu'] as $subMenu) {
                    if ($subMenu['route_name'] == $routeName && empty($secondMenu) && $subMenu['route_name'] != 'dashboard') {
                        $firstMenu = $menu['route_name'];
                        $firstPage = $menu['title'];
                        $secondMenu = $subMenu['route_name'];
                        $secondPage = $subMenu['title'];
                    }
                }
            }
        }

        return [
            'active_first_menu' => $firstMenu,
            'active_second_menu' => $secondMenu,
            'first_title' => $firstPage,
            'second_title' => $secondPage,
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
                'title' => 'Lahan',
                'sub_menu' => [
                    'daftar-lahan' => [
                        'icon' => 'fa-solid fa-list',
                        'route_name' => 'lahan.index',
                        'title' => 'Daftar Lahan'
                    ],
                    'tambah-lahan' => [
                        'icon' => 'fa-solid fa-plus',
                        'route_name' => 'lahan.create',
                        'title' => 'Tambah Lahan'
                    ],
                ]
            ],
            'tanaman' => [
                'icon' => 'fa-brands fa-pagelines',
                'route_name' => 'tanaman',
                'title' => 'Tanaman',
                'sub_menu' => [
                    'daftar-tanaman' => [
                        'icon' => 'fa-solid fa-list',
                        'route_name' => 'tanaman.index',
                        'title' => 'Daftar Penanaman'
                    ],
                    'tambah-tanaman' => [
                        'icon' => 'fa-solid fa-plus',
                        'route_name' => 'tanaman.create',
                        'title' => 'Tambah Penanaman'
                    ],
                ]
            ],
            // 'rekomendasi' => [
            //     'icon' => 'fa-solid fa-hands-holding-circle',
            //     'route_name' => 'rekomendasi',
            //     'title' => 'Rekomendasi',
            //     'sub_menu' => [
            //         'pengairan' => [
            //             'icon' => 'fa-solid fa-droplet',
            //             'route_name' => 'rekomendasi.pengairan',
            //             'title' => 'Pengairan'
            //         ],
            //         'pemupukan' => [
            //             'icon' => 'fa-solid fa-seedling',
            //             'route_name' => 'rekomendasi.pemupukan',
            //             'title' => 'Pemupukan'
            //         ]
            //     ]
            // ],
            'manual' => [
                'icon' => 'fa-solid fa-gears',
                'route_name' => 'manual',
                'title' => 'Input Data Manual',
                'sub_menu' => [
                    'tinggi' => [
                        'icon' => 'fa-solid fa-ruler-vertical',
                        'route_name' => 'manual.tinggi.create',
                        'title' => 'Tinggi Tanaman'
                    ],
                    'pengairan' => [
                        'icon' => 'fa-solid fa-faucet-drip',
                        'route_name' => 'manual.pengairan.create',
                        'title' => 'Pengairan'
                    ],
                    'pemupukan' => [
                        'icon' => 'fa-brands fa-pagelines',
                        'route_name' => 'manual.pemupukan.create',
                        'title' => 'Pemupukan'
                    ]
                ]
            ],
            'riwayat' => [
                'icon' => 'fa-solid fa-clock-rotate-left',
                'route_name' => 'riwayat.index',
                'title' => 'Riwayat',
            ],
            'panduan' => [
                'icon' => 'fa-solid fa-book',
                'route_name' => 'panduan',
                'title' => 'Panduan',
            ],
        ];
    }
}
