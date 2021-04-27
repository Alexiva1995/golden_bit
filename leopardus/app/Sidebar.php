<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    //
    public function object()
    {
    	switch ($this->type) {
    		case 0:
        		$model = SidebarHeader::class;
    			break;
    		
    		case 1:
    			$model = SidebarItem::class;
    			break;
    	}

    	return $this->hasOne($model, 'sidebar_id');
    }
}
