<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Repositories\CategoriaRepository;
use App\Repositories\CursoRepository;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected CategoriaRepository $repository;

    public function __construct()
    {
        $this->repository = new CategoriaRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->selectAllWith(['curso']);
        if (!isset($data)) {
            return '<h1>Index - No cursos found</h1>';
        }

        return $data;
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
        $curso = (new CursoRepository)->findById($request->curso_id);

        if (!isset($curso)) {
            return '<h1>Store - Curso not found</h1>';
        }

        $novaCategoria = new Categoria();
        $novaCategoria->nome = mb_strtoupper($request->nome, 'UTF-8');
        $novaCategoria->maximo_horas = $request->maximo_horas;
        $novaCategoria->curso()->associate($curso);
        $this->repository->save($novaCategoria);

        return '<h1>Store - OK!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = $this->repository->findByIdWith($id, ['curso']);

        if (!isset($categoria)) {
            return '<h1>Show - Categoria not found</h1>';
        }

        return $categoria;
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
        $categoria = $this->repository->findById($id);

        if (!isset($categoria)) {
            return '<h1>Categoria - Categoria not found</h1>';
        }

        $curso = (new CursoRepository())->findById($request->curso_id);

        if (!isset($curso)) {
            return '<h1>Update - Curso not found</h1>';
        }

        $categoria->nome = mb_strtoupper($request->nome, 'UTF-8');
        $categoria->maximo_horas = $request->maximo_horas;
        $categoria->curso()->associate($curso);
        $this->repository->save($categoria);

        return '<h1>Update - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isSucesso = $this->repository->delete($id);

        if (!$isSucesso) {
            return '<h1>Delete - Categoria not found!</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
