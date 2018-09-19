<?php
namespace App\Traits;

use App\Role;
use App\Permission;

trait HasPermissions
{
	public function givePrivilegeTo($model, ...$privileges)
	{
		$privileges = $this->getAllPrivileges($model, array_flatten($privileges));

		if ($privileges === null) {
			return $this;
		}

		$this->privileges($model)->saveMany($privileges);

		return $this;
	}

	public function givePermissionTo(...$permissions)
	{
		$permissions = $this->getAllPermissions(array_flatten($permissions));
		// dd($permissions);

		if ($permissions === null) {
			return $this;			
		}

		$this->permissions()->saveMany($permissions);

		return $this;
	}

	public function giveRoleTo(...$roles)
	{
		$roles = $this->getAllRoles(array_flatten($roles));
		// dd($roles);

		if ($roles === null) {
			return $this;			
		}

		$this->roles()->saveMany($roles);

		return $this;
	}

	public function revokePrivilegeTo($model, ...$privileges)
	{
		$privileges = $this->getAllPrivileges($model, array_flatten($privileges));

		$this->privileges($model)->detach($privileges);

		return $this;
	}

	public function revokePermissionTo(...$permissions)
	{
		$permissions = $this->getAllPermissions(array_flatten($permissions));

		$this->permissions()->detach($permissions);

		return $this;
	}

	public function syncPrivileges($model, ...$privileges)
	{
		$this->privileges($model)->detach();

		return $this->givePrivilegeTo($model, $privileges);
	}

	public function syncPermissions(...$permissions)
	{
		$this->permissions()->detach();

		return $this->givePermissionTo($permissions);
	}

	public function hasPermissionTo($permission)
	{
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
	}

	public function hasPrivilege($model, ...$privileges)
	{
		$privileges = array_flatten($privileges);

		foreach ($privileges as $privilege) {

			if ($this->privileges($model)->where('slug', $privilege)->count()) {
				return true;
			}
		}

		return false;
	}

	public function hasRole(...$roles)
	{
		$roles = array_flatten($roles);

		foreach ($roles as $role) {

			if ($this->roles->contains('slug', $role)) {
				return true;
			}
		}

		return false;
	}

	public function hasPermission(...$permission)
	{
		$permissions = array_flatten($permission);

		foreach ($permissions as $permission) {

			if ($this->permissions->where('slug', $permission)->count()) {
				return true;
			}
		}

		return false;
	}

	protected function getAllPermissions(array $permissions)
	{
		return Permission::whereIn('slug', $permissions)->get();
	}

	protected function hasPermissionThroughRole($permission)
	{
		foreach ($permission->roles as $role) {
			if ($this->roles->contains($role)) {
				return true;
			}
		}

		return false;
	}

	protected function getAllRoles(array $roles)
	{
		return Role::whereIn('slug', $roles)->get();
	}


	protected function getAllPrivileges($model, array $privileges)
	{
		return $model::whereIn('slug', $privileges)->get();
	}

	public function privileges($model)
	{
		return $this->belongsToMany($model);
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class);
	}
}