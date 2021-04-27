<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidebarItem extends Model
{
    //

    public function subs()
    {
    	return $this->hasMany(SidebarItem::class, 'parent_id');
    }
}
