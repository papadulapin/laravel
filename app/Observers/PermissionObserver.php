<?php

namespace App\Observers;

use App\Permission;

class PermissionObserver
{
    /**
     * Handle the permission "created" event.
     *
     * @param  \App\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        //
    }

    /**
     * Handle the permission "updated" event.
     *
     * @param  \App\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        //
    }

    /**
     * Handle the permission "deleting" event.
     *
     * @param  \App\Permission  $permission
     * @return void
     */
    public function deleting(Permission $permission)
    {
        // dd('Deleting a permission now!');
    }

    /**
     * Handle the permission "deleted" event.
     *
     * @param  \App\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        //update all roles that has the permission
        if ($allRoles = $permission->roles) {
            foreach($allRoles as $role){
                $role->revokePrivilegeTo(Permission::class, $permission->slug);
            } 
        }
        
        session()->flash('message', 'The permission has been deleted!');
    }

    /**
     * Handle the permission "restored" event.
     *
     * @param  \App\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        //
    }

    /**
     * Handle the permission "force deleted" event.
     *
     * @param  \App\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        //
    }
}
