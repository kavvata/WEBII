<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    protected TurmaRepository $repository;

    public function __construct()
    {
        $this->repository = new TurmaRepository();
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

        $novaTurma = new Turma();
        $novaTurma->ano = $request->ano;
        $novaTurma->curso()->associate($curso);

        $this->repository->save($novaTurma);

        return '<h1>Store - OK!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $turma = $this->repository->findByIdWith($id, ['curso']);

        if (!isset($turma)) {
            return '<h1>Show - Turma not found</h1>';
        }

        return $turma;
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
        $turma = $this->repository->findById($id);

        if (!isset($turma)) {
            return '<h1>Update - Turma not found</h1>';
        }

        $curso = (new CursoRepository())->findById($request->curso_id);

        if (!isset($curso)) {
            return '<h1>Update - Curso not found</h1>';
        }

        $turma->ano = $request->ano;
        $turma->curso()->associate($curso);

        $this->repository->save($turma);

        return '<h1>Update - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isSucesso = $this->repository->delete($id);

        if (!$isSucesso) {
            return '<h1>Delete - Turma not found!</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
