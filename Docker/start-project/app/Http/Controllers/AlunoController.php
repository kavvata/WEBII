<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Repositories\AlunoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    protected AlunoRepository $repository;
    private $orms = ['user', 'curso', 'turma'];

    public function __construct()
    {
        $this->repository = new AlunoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): mixed
    {
        $listaAlunos = $this->repository->selectAllWith($this->orms);

        if (!isset($listaAlunos)) {
            return '<h1>Index - No alunos found</h1>';
        }

        return $listaAlunos;
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
        $user = (new UserRepository())->findById($request->user_id);

        if (!isset($user)) {
            return '<h1> Store - User not found </h1>';
        }

        $curso = (new CursoRepository())->findById($request->user_id);

        if (!isset($curso)) {
            return '<h1> Store - User not found </h1>';
        }

        $turma = (new TurmaRepository())->findById($request->turma_id);

        if (!isset($turma)) {
            return '<h1> Store - Turma not found </h1>';
        }

        $novoAluno = new Aluno();
        $novoAluno->nome = mb_strtoupper($request->nome, 'UTF-8');
        $novoAluno->cpf = $request->cpf;
        $novoAluno->email = $request->email;
        $novoAluno->senha = $request->senha;
        $novoAluno->user()->associate($user);
        $novoAluno->curso()->associate($curso);
        $novoAluno->turma()->associate($turma);

        $this->repository->save($novoAluno);

        return '<h1>Store - OK!</h1>';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->findByIdWith($id, $this->orms);
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
        $aluno = $this->repository->findById($id);

        if (!isset($aluno)) {
            return '<h1> Update - Aluno not found </h1>';
        }

        $user = (new UserRepository())->findById($request->user_id);

        if (!isset($user)) {
            return '<h1> Update - User not found </h1>';
        }

        $curso = (new CursoRepository())->findById($request->user_id);

        if (!isset($curso)) {
            return '<h1> Update - Curso not found </h1>';
        }

        $turma = (new TurmaRepository())->findById($request->turma_id);

        if (!isset($turma)) {
            return '<h1> Update - Turma not found </h1>';
        }

        $aluno->nome = mb_strtoupper($request->nome, 'UTF-8');
        $aluno->cpf = $request->cpf;
        $aluno->email = $request->email;
        $aluno->senha = $request->senha;
        $aluno->user()->associate($user);
        $aluno->curso()->associate($curso);
        $aluno->turma()->associate($turma);

        $this->repository->save($aluno);

        return '<h1>Store - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        $isSucesso = $this->repository->delete($id);

        if (!$isSucesso) {
            return '<h1>Delete - Aluno not found.</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
