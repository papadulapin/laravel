<?php

namespace App;

use App\BaseModel;
use App\Permission;
use App\Traits\HasPermissions;
use Carbon\Carbon;

class Role extends BaseModel
{
    use HasPermissions;

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
