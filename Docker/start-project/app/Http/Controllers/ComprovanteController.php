<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Repositories\AlunoRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\ComprovanteRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ComprovanteController extends Controller
{
    protected ComprovanteRepository $repository;

    private array $orms = ['categoria', 'aluno', 'user'];

    public function __construct()
    {
        $this->repository = new ComprovanteRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->selectAllWith($this->orms);
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
        $categoria = (new CategoriaRepository())->findById($request->categoria_id);

        if (!isset($categoria)) {
            return '<h1>Store - Categoria not found</h1>';
        }

        $aluno = (new AlunoRepository())->findById($request->aluno_id);

        if (!isset($aluno)) {
            return '<h1>Store - Aluno not found</h1>';
        }

        $user = (new UserRepository())->findById($request->user_id);

        if (!isset($user)) {
            return '<h1>Store - User not found</h1>';
        }

        $novoComprovante = new Comprovante();
        $novoComprovante->horas = $request->horas;
        $novoComprovante->atividade = mb_strtoupper($request->atividade, 'UTF-8');
        $novoComprovante->categoria()->associate($categoria);
        $novoComprovante->aluno()->associate($aluno);
        $novoComprovante->user()->associate($user);

        $this->repository->save($novoComprovante);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comprovante = $this->repository->findById($id);

        if (!isset($comprovante)) {
            return '<h1>Update - Comprovante not found</h1>';
        }

        $categoria = (new CategoriaRepository())->findById($request->categoria_id);

        if (!isset($categoria)) {
            return '<h1>Update - Categoria not found</h1>';
        }

        $aluno = (new AlunoRepository())->findById($request->aluno_id);

        if (!isset($aluno)) {
            return '<h1>Update - Aluno not found</h1>';
        }

        $user = (new UserRepository())->findById($request->user_id);

        if (!isset($user)) {
            return '<h1>Update - User not found</h1>';
        }

        $comprovante->horas = $request->horas;
        $comprovante->atividade = mb_strtoupper($request->atividade, 'UTF-8');
        $comprovante->categoria()->associate($categoria);
        $comprovante->aluno()->associate($aluno);
        $comprovante->user()->associate($user);

        $this->repository->save($comprovante);

        return '<h1>Update - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isSucesso = $this->repository->delete($id);

        if (!isSucesso) {
            return '<h1>Delete - Comprovante not found</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
