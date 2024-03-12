<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use App\Repositories\ResourceRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected PermissionRepository $repository;

    public function __construct()
    {
        $this->repository = new PermissionRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->selectAllWith(['role', 'resource']);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        $role = (new RoleRepository)->findById($request->role_id);
        $resource = (new ResourceRepository)->findById($request->resource_id);

        if (!isset($role) || !isset($resource)) {
            return '<h1>Store - Not found Role or Resource!</h1>';
        }

        $novaPermission = new Permission();

        $novaPermission->permission = $request->permissao;
        $novaPermission->role()->associate($role);
        $novaPermission->resource()->associate($resource);

        $this->repository->save($novaPermission);
        return '<h1>Store - OK!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): object
    {
        return $this->repository->findByCompositeIdWith(
            Permission::getKeys(),
            explode('_', $id),
            ['role', 'resource']
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): string
    {
        $permission = $this->repository->findByCompositeId(Permission::getKeys(), explode('_', $id));

        if (!isset($permission)) {
            return '<h1> Update - Permission not found </h1>';
        }

        $role = (new RoleRepository())->findById($request->role_id);
        if (!isset($role)) {
            return '<h1> Update - Role not found </h1>';
        }

        $resource = (new ResourceRepository())->findById($request->resource_id);
        if (!isset($resource)) {
            return '<h1> Update - Resource not found </h1>';
        }

        $isSucesso = $this->repository->updateCompositeId(
            Permission::getKeys(),
            explode('_', $id),
            'permissions',
            ['permission' => $request->permissao]
        );

        if (!$isSucesso) {
            return '<h1> Update - Erro ao atualizar </h1>';
        }

        return '<h1> Update - OK </h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        $isSucesso = $this->repository->deleteCompositeId(
            Permission::getKeys(),
            explode('_', $id),
            'permissions'
        );

        if (!$isSucesso) {
            return '<h1> Delete - Permission not found. </h1>';
        }

        return '<h1> Delete - OK </h1>';
    }
}
