<?php

namespace App;

use App\Role;
use App\BaseModel;
use Carbon\Carbon;

class Permission extends BaseModel
{
    public function roles()
    {
    	return $this->belongsToMany(Role::class, 'permission_role');
    }
}

