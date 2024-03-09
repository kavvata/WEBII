<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Repositories\CursoRepository;
use App\Repositories\EixoRepository;
use App\Repositories\NivelRepository;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    protected CursoRepository $repository;

    public function __construct()
    {
        $this->repository = new CursoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->selectAllWith(['eixo', 'nivel']);

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
        $eixo = (new EixoRepository)->findById($request->eixo_id);
        $nivel = (new NivelRepository)->findById($request->eixo_id);

        if (!isset($eixo) || !isset($nivel)) {
            return '<h1>Store - Not found Eixo or Nível!</h1>';
        }

        $novoCurso = new Curso();

        $novoCurso->nome = mb_strtoupper($request->nome, 'UTF-8');
        $novoCurso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
        $novoCurso->total_horas = $request->horas;
        $novoCurso->eixo()->associate($eixo);
        $novoCurso->nivel()->associate($nivel);

        $this->repository->save($novoCurso);
        return '<h1>Store - OK!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->findById($id);
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
        $curso = $this->repository->findById($id);

        if (!isset($curso)) {
            return '<h1>Update - Curso not found!</h1>';
        }

        $eixo = (new EixoRepository)->findById($request->eixo_id);
        $nivel = (new NivelRepository)->findById($request->nivel_id);

        if (!isset($eixo) || !isset($nivel)) {
            return '<h1>Update - Eixo or Nivel not found!</h1>';
        }

        $curso->nome = strtoupper($request->nome, 'UTF-8');
        $curso->sigla = strtoupper($request->nome, 'UTF-8');
        $curso->total_horas = $request->horas;

        $curso->eixo()->associate($eixo);
        $curso->nivel()->associate($nivel);
        $this->repository->save($curso);

        return '<h1>Update - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        $isSuccess = $this->repository->delete($id);

        if (!$isSuccess) {
            return '<h1>Delete - Curso not found!</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
