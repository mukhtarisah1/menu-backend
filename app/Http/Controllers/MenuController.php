<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Services\MenuServices;
use Illuminate\Http\Request;
use App\Services\MenuService;


class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = $this->menuService->getAllMenus();
        return response()->json($menus);
    }

    public function show($id)
    {
        $menu = $this->menuService->getMenuWithChildren($id);
        return response()->json($menu);
    }

    // public function store(Request $request){
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'parent_id' => 'nullable|exists:menus,id',
    //         'depth' => 'required|integer',
           
    //     ]);
    //     //dd($validatedData);
    //     $menu = $this->menuService->createMenu($validatedData);
    //     return response()->json($menu, 201);
    // }


//         public function store(Request $request)
// {
//     try {
//         $validatedData = $request->validate([
//             'title' => 'required|string|max:255',
//             'depth' => 'required|integer',
//             'parent_id' => 'nullable|integer|exists:menus,id',
//         ]);

//         $menu = Menu::create($validatedData);
//         return response()->json($menu, 201);
//     } catch (\Exception $e) {
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// }

public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'parent_id' => 'nullable|integer|exists:menus,id'
    ]);

    $parent = Menu::find($validatedData['parent_id']);
    
    // Insert as the last child of the parent
    $newMenu = new Menu($validatedData);
    $newMenu->depth = $parent ? $parent->depth + 1 : 0;
    $newMenu->save();

    // Adjust lft and rgt using Nested Set Model logic if required

    return response()->json($newMenu, 201);
}

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'required|exists:menus,id',
            'depth' => 'required|integer',
            
        ]);

        $menu = $this->menuService->updateMenu($id, $validatedData);
        return response()->json($menu);
    }

    public function destroy($id){

        $menu = $this->menuService->deleteMenu($id);
        return response()->json(null, 204);
    }
}

