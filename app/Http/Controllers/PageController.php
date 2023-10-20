<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use \Illuminate\Http\Request;
// use Illuminate\Http\Response;

class PageController extends Controller
{
    public function loadPage($pageName = 'dashboard')
    {
        $activeMenu = $this->activeMenu($pageName);
        $menus = $this->sideMenu();
        return view('pages/' . $pageName, [
            'side_menu' => $menus,
            'first_page_name' => $activeMenu['first_page_name'],
            'second_page_name' => $activeMenu['second_page_name'],
            'third_page_name' => $activeMenu['third_page_name'],
            'layout' => 'side-menu'
        ]);
    }

    public function activeMenu($pageName)
    {
        $firstPageName = '';
        $secondPageName = '';
        $thirdPageName = '';

        foreach ($this->sideMenu() as $menu) {
            if ($menu !== 'devider' && $menu['page_name'] == $pageName && empty($firstPageName)) {
                $firstPageName = $menu['page_name'];
            }

            if (isset($menu['sub_menu'])) {
                foreach ($menu['sub_menu'] as $subMenu) {
                    if ($subMenu['page_name'] == $pageName && empty($secondPageName) && $subMenu['page_name'] != 'dashboard') {
                        $firstPageName = $menu['page_name'];
                        $secondPageName = $subMenu['page_name'];
                    }
                }
            }
        }

        return [
            'first_page_name' => $firstPageName,
            'second_page_name' => $secondPageName,
            'third_page_name' => $thirdPageName
        ];
    }

    public function sideMenu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'page_name' => 'dashboard',
                'title' => 'Dashboard'
            ],
            'lahan' => [
                'icon' => 'inbox',
                'page_name' => 'lahan',
                'title' => 'Lahan'
            ],
            'tanaman' => [
                'icon' => 'hard-drive',
                'page_name' => 'index',
                'title' => 'Tanaman',
                'sub_menu' => [
                    'daftar-tanaman' => [
                        'icon' => '',
                        'page_name' => 'tanaman/daftar-tanaman',
                        'title' => 'Daftar Tanaman'
                    ],
                    'tambah-tanaman' => [
                        'icon' => '',
                        'page_name' => 'tanaman/tambah-tanaman',
                        'title' => 'Tambah Tanaman'
                    ],
                ]
            ],
            'rekomendasi' => [
                'icon' => 'edit',
                'page_name' => 'rekomendasi/pengairan',
                'title' => 'Rekomendasi',
                'sub_menu' => [
                    'pengairan' => [
                        'icon' => '',
                        'page_name' => 'rekomendasi/pengairan',
                        'title' => 'Pengairan'
                    ],
                    'pemupukan' => [
                        'icon' => '',
                        'page_name' => 'rekomendasi/pemupukan',
                        'title' => 'Pemupukan'
                    ]
                ]
            ],
            'riwayat' => [
                'icon' => 'users',
                'page_name' => 'riwayat/tinggi-tanaman',
                'title' => 'Riwayat',
                'sub_menu' => [
                    'tinggi-tanaman' => [
                        'icon' => '',
                        'page_name' => 'riwayat/tinggi-tanaman',
                        'title' => 'Tinggi Tanaman'
                    ],
                    'rekomendasi' => [
                        'icon' => '',
                        'page_name' => 'riwayat/rekomendasi',
                        'title' => 'Rekomendasi'
                    ],
                ]
            ],
            'panduan' => [
                'icon' => 'trello',
                'page_name' => 'panduan',
                'title' => 'Panduan',
            ],
        ];
    }
}
