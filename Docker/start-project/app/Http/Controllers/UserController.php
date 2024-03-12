<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\CursoRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listaUsers = $this->repository->selectAllWith(['role', 'curso']);

        if (!isset($listaUsers)) {
            return '<h1>Index - No users found</h1>';
        }

        return $listaUsers;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = (new RoleRepository)->findById($request->role_id);

        if (!isset($role)) {
            return '<h1> Store - Role not found. </h1>';
        }

        $curso = (new CursoRepository)->findById($request->curso_id);

        if (!isset($curso)) {
            return '<h1> Store - Curso not found. </h1>';
        }

        $novoUser = new User();
        $novoUser->nome = $request->nome;
        $novoUser->email = $request->email;
        $novoUser->senha = $request->senha;
        $novoUser->role()->associate($role);
        $novoUser->curso()->associate($curso);

        $this->repository->save($novoUser);

        return '<h1> Store - OK </h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->findByIdWith($id, ['role', 'curso']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $this->repository->findById($id);

        if (!isset($user)) {
            return '<h1> Update - User not found </h1>';
        }

        $role = (new RoleRepository())->findById($request->role_id);

        if (!isset($role)) {
            return '<h1> Update - Role not found </h1>';
        }

        $curso = (new CursoRepository())->findById($request->curso_id);

        if (!isset($curso)) {
            return '<h1> Update - Curso not found </h1>';
        }

        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->senha = $request->senha;
        $user->role()->associate($role);
        $user->curso()->associate($curso);

        $this->repository->save($user);

        return '<h1> Update - OK </h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isSucesso = $this->repository->delete($id);

        if (!isSucesso) {
            return '<h1> Delete - Permission not found. </h1>';
        }

        return '<h1> Delete - OK </h1>';
    }
}
