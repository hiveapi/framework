<?php

namespace App\Containers\Authorization\UI\API\Controllers;

use App\Containers\Authorization\Actions\AssignUserToRoleAction;
use App\Containers\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\Authorization\Actions\CreateRoleAction;
use App\Containers\Authorization\Actions\DeleteRoleAction;
use App\Containers\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\Authorization\Actions\FindPermissionAction;
use App\Containers\Authorization\Actions\FindRoleAction;
use App\Containers\Authorization\Actions\GetAllPermissionsAction;
use App\Containers\Authorization\Actions\GetAllRolesAction;
use App\Containers\Authorization\Actions\RevokeUserFromRoleAction;
use App\Containers\Authorization\Actions\SyncPermissionsOnRoleAction;
use App\Containers\Authorization\Actions\SyncUserRolesAction;
use App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Containers\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\Authorization\UI\API\Requests\RevokeUserFromRoleRequest;
use App\Containers\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\GetAllPermissionsRequest $request
     *
     * @return  mixed
     */
    public function getAllPermissions(GetAllPermissionsRequest $request)
    {
        $permissions = Hive::call(GetAllPermissionsAction::class);

        return $this->transform($permissions, PermissionTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\FindPermissionRequest $request
     *
     * @return  mixed
     */
    public function findPermission(FindPermissionRequest $request)
    {
        $permission = Hive::call(FindPermissionAction::class, [new DataTransporter($request)]);

        return $this->transform($permission, PermissionTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\GetAllRolesRequest $request
     *
     * @return  mixed
     */
    public function getAllRoles(GetAllRolesRequest $request)
    {
        $roles = Hive::call(GetAllRolesAction::class);

        return $this->transform($roles, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\FindRoleRequest $request
     *
     * @return  mixed
     */
    public function findRole(FindRoleRequest $request)
    {
        $role = Hive::call(FindRoleAction::class, [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest $request
     *
     * @return  mixed
     */
    public function assignUserToRole(AssignUserToRoleRequest $request)
    {
        $user = Hive::call(AssignUserToRoleAction::class, [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\SyncUserRolesRequest $request
     *
     * @return  mixed
     */
    public function syncUserRoles(SyncUserRolesRequest $request)
    {
        $user = Hive::call(SyncUserRolesAction::class, [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\DeleteRoleRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteRole(DeleteRoleRequest $request)
    {
        Hive::call(DeleteRoleAction::class, [new DataTransporter($request)]);

        return $this->noContent();
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\RevokeUserFromRoleRequest $request
     *
     * @return  mixed
     */
    public function revokeRoleFromUser(RevokeUserFromRoleRequest $request)
    {
        $user = Hive::call(RevokeUserFromRoleAction::class, [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest $request
     *
     * @return  mixed
     */
    public function attachPermissionToRole(AttachPermissionToRoleRequest $request)
    {
        $role = Hive::call(AttachPermissionsToRoleAction::class, [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest $request
     *
     * @return  mixed
     */
    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request)
    {
        $role = Hive::call(SyncPermissionsOnRoleAction::class, [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\DetachPermissionToRoleRequest $request
     *
     * @return  mixed
     */
    public function detachPermissionFromRole(DetachPermissionToRoleRequest $request)
    {
        $role = Hive::call(DetachPermissionsFromRoleAction::class, [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param \App\Containers\Authorization\UI\API\Requests\CreateRoleRequest $request
     *
     * @return  mixed
     */
    public function createRole(CreateRoleRequest $request)
    {
        $role = Hive::call(CreateRoleAction::class, [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

}
