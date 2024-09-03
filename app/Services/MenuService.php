<?php
namespace App\Services;
use App\Models\Menu;

class MenuService
{
    public function getAllMenus(){
        return Menu::all();
    }
    public function getMenuWithChildren($id){
        return Menu::with('children')->findOrFail($id);
    }

    public function createMenu(array $data)
    {
        return Menu::create($data);
    }

    public function updateMenu($id, array $data)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($data);
        return $menu;
    }

    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return null;
    }
}