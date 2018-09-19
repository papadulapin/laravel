<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Http\Requests\PermissionForm;
use Illuminate\Http\Request;
use App\Traits\Slugify;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    use Slugify;

    protected $guard = [];

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PermissionForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionForm $request)
    {
        $permission = [
            'name' => $request->name,
            'slug' => Slugify::generateSlug('permissions', 'slug', $request->name, $delimiter = '.'),
        ];

        $permission = Permission::create($permission);

        session()->flash('message', 'A new permission has been added!');

        return redirect('/admin/permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
         return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PermissionForm  $request
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionForm $request, Permission $permission)
    {
        $permission->name = $request->name;
        $permission->slug = $request->slug;

        $permission->save();

        session()->flash('message', 'The permission has been updated!');

        return redirect('/admin/permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {        
        //update all roles that has the permission
        $allRoles = $permission->roles;

        foreach($allRoles as $role){
            $role->revokePrivilegeTo(Permission::class, $permission->slug);
        }
        
        $permission->delete();

        session()->flash('message', 'The permission has been deleted!');

        return redirect('/admin/permissions');
    }
}