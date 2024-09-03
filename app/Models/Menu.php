<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
     public $timestamps = false;
    use HasFactory;

    protected $fillable = ['title', 'parent_id', 'depth'];

    public function children(){
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}
