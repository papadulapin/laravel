<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests\RoleForm;
use App\Traits\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    use Slugify;

    protected $guard = [];

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::class;
        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleForm $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleForm $request)
    {
        $role = [
            'name' => $request->name,
            'slug' => Slugify::generateSlug('roles', 'slug', $request->name, $delimiter = '.'),
        ];

        $role = Role::create($role);

        if ($request->permissions) {

            //loop through all selected permissions
            foreach( $request->permissions as $permission ) {

                $perm = Permission::where('id', '=', $permission)->firstOrFail();

                //permission assignment
                $role = Role::where('slug', '=', $role->slug)->firstOrFail();

                $role->givePrivilegeTo(Permission::class, $perm->slug);
         
            }
        }

        session()->flash('message', 'A new role has been added!');

        return redirect('/admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
   public function edit(Role $role)
    {
        $permissions = $role->permissions();

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\RoleForm  $request
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleForm $request, Role $role)
    {
        $role->name = $request->name;
        $role->slug = $request->slug;

        $role->save();

        //revoke all permissions for starter
        $role->permissions()->detach();

        //some permissions checked
        if ($request->permissions) {

            //assign the permission to the checked ones
            foreach (Permission::all() as $permission) {
                
                if(in_array($permission->id, $request->permissions)) {
                    $role->givePrivilegeTo(Permission::class, $permission->slug);
                } 
            } 
        }  

        session()->flash('message', 'The role has been updated!');

        return redirect('/admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        //detach all permissioned assigned to the role
        $role->permissions()->detach();

        session()->flash('message', 'The role has been deleted!');

        return redirect('/admin/roles');
    }
}