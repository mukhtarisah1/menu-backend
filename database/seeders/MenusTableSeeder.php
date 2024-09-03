<?php
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        $systemManagement = Menu::create(['title' => 'System Management', 'depth' => 0]);
        $systemCode = Menu::create(['title' => 'System Code', 'parent_id' => $systemManagement->id, 'depth' => 1]);
        $codeRegistration = Menu::create(['title' => 'Code Registration - 2', 'parent_id' => $systemManagement->id, 'depth' => 1]);
        $properties = Menu::create(['title' => 'Properties', 'parent_id' => $systemManagement->id, 'depth' => 1]);
        $menus = Menu::create(['title' => 'Menus', 'parent_id' => $systemManagement->id, 'depth' => 1]);
        $menuRegistration = Menu::create(['title' => 'Menu Registration', 'parent_id' => $menus->id, 'depth' => 2]);

        // Additional sample data...
    }
}
