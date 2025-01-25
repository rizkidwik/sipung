<?php

use App\Models\Configuration;
use App\Models\LogPertemuan;
use App\Models\Menu;
use App\Models\LogUser;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getMenus')) {
    function getMenus(){
        $menu = Menu::with('subMenus')->where('active', 1)->whereNull('main_menu')->orderBy('sort')->get();
        return $menu;
    }
}
if (!function_exists('isMenuAllowed')) {
    function isMenuAllowed($menu){
        $userRole = Auth::user();
        if($userRole){
            // Cek apakah menu memiliki role yang sesuai dengan role pengguna
            return $menu->roles->contains('id', $userRole->role_id);
        }
        abort(403,'Unauthorized');
    }
}

if (!function_exists('addLogUser')) {
    function addLogUser($activity){
        LogUser::create([
            'user_id' => auth()->user()->id,
            'activity' => $activity ?? null,
            'ip_address' => request()->ip(),
        ]);
    }
}

if (!function_exists('getTitle')) {
    function getTitle() {
        $title = Configuration::where('config_code','app.name')->first();

        return $title['config_value'] ?? '-';
    }
}

if(!function_exists('formatRupiah')){
    function formatRupiah($amount){
        $formatted = number_format($amount, 0, ',', '.');
        return 'Rp ' . $formatted;
    }
}
