<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email,',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],            
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ];

        $user = User::create($user);

        //some roles checked
        if ($request->roles) {

            foreach ($request->roles as $role) {

                $role = Role::where('id', '=', $role)->firstOrFail();

                //roles assignment
                $user->givePrivilegeTo(Role::class, $role->slug);
            }
        }

        //some permissions checked
        if ($request->permissions) {

            foreach ($request->permissions as $permission) {

                $permission = Permission::where('id', '=', $permission)->firstOrFail();

                //permissions assignment
                $user->givePrivilegeTo(Permission::class, $permission->slug);
            }
        } 

        session()->flash('message', 'A new user has been added!');

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id
        ]);

        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];          
        $user->name = $validated['first_name'] . ' ' . $validated['last_name'];
        $user->email = $validated['email'];

        $user->save();

        //update roles
        //revoke all roles for starter
        $user->privileges(Role::class)->detach();

        //assign the selected roles only if checked
        if ($request->roles) {

            foreach (Role::all() as $privilege) {

                if (in_array($privilege->id, $request->roles)) {

                    $user->givePrivilegeTo(Role::class, $privilege->slug);
                } 
            }    
        }

        //update permissions
        //revoke all permissions for starter
        $user->privileges(Permission::class)->detach();

        //assign the selected permissions only if checked
        if ($request->permissions) {

            foreach (Permission::all() as $privilege) {

                if (in_array($privilege->id, $request->permissions)) {

                    $user->givePrivilegeTo(Permission::class, $privilege->slug);
                } 
            }    
        }      

        session()->flash('message', 'The user has been updated!');

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {        
        $user->delete();

        $user->privileges(Role::class)->detach();
        $user->privileges(Permission::class)->detach();
        
        session()->flash('message', 'The user has been deleted!');

        return redirect('/admin/users');
    }
}