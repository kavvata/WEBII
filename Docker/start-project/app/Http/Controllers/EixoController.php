<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use App\Repositories\EixoRepository;
use Illuminate\Http\Request;

class EixoController extends Controller
{
    protected EixoRepository $repository;

    public function __construct()
    {
        $this->repository = new EixoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): object
    {
        $data = $this->repository->selectAll();
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
        $obj = new Eixo();
        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($obj);

        return '<h1>Store - OK!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Eixo
    {
        $data = $this->repository->findById($id);
        return $data;
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
        $obj = $this->repository->findById($id);

        if (!isset($obj)) {
            return '<h1>Update - Not found Eixo!</h1>';
        }

        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');

        $this->repository->save($obj);

        return '<h1>Update - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): bool
    {
        if (!$this->repository->delete($id)) {
            return '<h1>Delete - Not found Eixo!</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
