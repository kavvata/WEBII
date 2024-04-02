<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use App\Repositories\NivelRepository;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    protected NivelRepository $repository;

    public function __construct()
    {
        $this->repository = new NivelRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): object
    public function index()
    {
        $data = $this->repository->selectAll();
        return $data;
        $data = $this->repository->selectAllWith(['curso']);
        return view('nivel.index', compact('data'));
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
        $obj = new Nivel();
        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($obj);

        return '<h1>Store - OK!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Nivel
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
        $nivel = $this->repository->findById($id);
        if (!isset($nivel)) {
            return '<h1>Update - Not found Nivel!</h1>';
        }

        $nivel->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($nivel);

        return '<h1>Update - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        if (!$this->repository->delete($id)) {
            return '<h1>Delete - Not found Eixo!</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
