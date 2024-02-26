<?php

namespace App\Http\Controllers\Utility;

use App\Models\ListMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandlesTransaction;

class MenuController extends Controller
{
    use HandlesTransaction;

    public function index(){
        $overall = []; $menus = []; $listahan = [];
        $lists = ListMenu::where('is_mother',1)->where('group','Menu')->get();
        foreach($lists as $list){
            
            $submenus = [];
            if($list['has_child']){
                $subs = ListMenu::where('group',$list['name'])->get();
                foreach($subs as $menu){
                    $submenus[] = $menu;
                }
            }
            $menus[] = [
                'main' => $list,
                'submenus' => $submenus
            ];
        }

        $lists = ListMenu::where('is_mother',1)->where('group','Lists')->get();
        foreach($lists as $list){
            
            $submenus = [];
            if($list['has_child']){
                $subs = ListMenu::where('group',$list['name'])->get();
                foreach($subs as $menu){
                    $submenus[] = $menu;
                }
            }
            $listahan[] = [
                'main' => $list,
                'submenus' => $submenus
            ];
        }
        return $overall = [
            'menus' => $menus,
            'lists' => $listahan
        ];
    }

    public function store(Request $request){
        $result = $this->handleTransaction(function () use ($request) {
            $count = ListMenu::where('is_mother',1)->count() + 1;
            $menu = ListMenu::create(array_merge($request->all(),['order' => $count]));

            if($request->has_child){
                $submenus = $request->submenus;
                foreach($submenus as $key => $submenu){
                    $menu = new ListMenu;
                    $menu->name = $submenu['name'];
                    $menu->route = $submenu['route'];
                    $menu->path = $submenu['path'];
                    $menu->is_mother = 0;
                    $menu->has_child = 0;
                    $menu->group = $request->name;
                    $menu->order = $key+1;
                    $menu->save();
                }
            }
            return [
                'data' => $menu,
                'message' => 'Menu creation was successful!', 
                'info' => "You've successfully created a menu."
            ];
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }
}
