<?php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use App\Repositories\AlunoRepository;
use App\Repositories\ComprovanteRepository;
use App\Repositories\DeclaracaoRepository;
use Illuminate\Http\Request;

class DeclaracaoController extends Controller
{
    protected DeclaracaoRepository $repository;

    private $orms = ['aluno', 'comprovante'];

    public function __construct()
    {
        $this->repository = new DeclaracaoRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): mixed
    {
        return $this->repository->selectAllWith($this->orms);
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
        $aluno = (new AlunoRepository())->findById($request->aluno_id);

        if (!isset($aluno)) {
            return '<h1>Store - Aluno not found</h1>';
        }

        $comprovante = (new ComprovanteRepository())->findById($request->comprovante_id);

        if (!isset($comprovante)) {
            return '<h1>Store - Comprovante not found</h1>';
        }

        $novaDeclaracao = new Declaracao();
        $novaDeclaracao->hash = $request->hash;
        $novaDeclaracao->data = $request->data;
        $novaDeclaracao->aluno()->associate($aluno);
        $novaDeclaracao->comprovante()->associate($comprovante);

        $this->repository->save($novaDeclaracao);

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
    public function edit(string $id): void {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): string
    {
        $declaracao = $this->repository->findById($id);

        if (!isset($declaracao)) {
            return '<h1>Update - Declaracao not found</h1>';
        }

        $aluno = (new AlunoRepository())->findById($request->aluno_id);

        if (!isset($aluno)) {
            return '<h1>Update - Aluno not found</h1>';
        }

        $comprovante = (new ComprovanteRepository())->findById($request->comprovante_id);

        if (!isset($comprovante)) {
            return '<h1>Update - Comprovante not found</h1>';
        }

        $declaracao->hash = $request->hash;
        $declaracao->data = $request->data;
        $declaracao->aluno()->associate($aluno);
        $declaracao->comprovante()->associate($comprovante);

        $this->repository->save($declaracao);

        return '<h1>Update - OK!</h1>';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        $isSucesso = $this->repository->delete($id);

        if (!$isSucesso) {
            return '<h1>Delete - Declaracao Not Found.</h1>';
        }

        return '<h1>Delete - OK!</h1>';
    }
}
