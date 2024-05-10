<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CategoriaRepository;
use App\Repositories\CursoRepository;
use App\Models\Categoria;

class CategoriaController extends Controller {

    protected $repository;

    public function __construct(){
        $this->repository = new CategoriaRepository();
    }

    public function index() {

        $this->authorize('hasFullPermission', Categoria::class);
        $data = $this->repository->findByColumnWith('curso_id', Auth::user()->curso_id, ['curso']);
        return view('categoria.index', compact('data'));    
    }

    public function create() {

        $this->authorize('hasFullPermission', Categoria::class);
        $cursos = (new CursoRepository())->selectAll();
        return view('categoria.create', compact(['cursos']));
    }

    public function store(Request $request) {
        
        $this->authorize('hasFullPermission', Categoria::class);
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        
        if(isset($objCurso)) {
            $obj = new Categoria();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->maximo_horas = $request->maximo_horas;
            $obj->curso()->associate($objCurso);
            $this->repository->save($obj);
            return redirect()->route('categoria.index');
        }
        
        return view('message')
                ->with('template', "main")
                ->with('type', "danger")
                ->with('titulo', "OPERAÇÃO INVÁLIDA")
                ->with('message', "Não foi possível efetuar o procedimento!")
                ->with('link', "categoria.index");
    }

    public function show(string $id) {

        $this->authorize('hasFullPermission', Categoria::class);
        $cursos = (new CursoRepository())->selectAll();
        $data = $this->repository->findByIdWith(['curso'], $id);
        if(isset($data))
            return view('categoria.show', compact(['data', 'cursos']));

        return view('message')
                ->with('template', "main")
                ->with('type', "danger")
                ->with('titulo', "OPERAÇÃO INVÁLIDA")
                ->with('message', "Não foi possível efetuar o procedimento!")
                ->with('link', "categoria.index");
    }

    public function edit(string $id) {
        
        $this->authorize('hasFullPermission', Categoria::class);
        $data = $this->repository->findById($id);
        if(isset($data)) {
            $cursos = (new CursoRepository())->selectAll();
            return view('categoria.edit', compact(['data', 'cursos']));
        }

        return view('message')
                    ->with('template', "main")
                    ->with('type', "danger")
                    ->with('titulo', "OPERAÇÃO INVÁLIDA")
                    ->with('message', "Não foi possível efetuar o procedimento!")
                    ->with('link', "categoria.index");
    }

    public function update(Request $request, string $id) {

        $this->authorize('hasFullPermission', Categoria::class);
        $obj = $this->repository->findById($id);
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        
        if(isset($obj) && isset($objCurso)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->maximo_horas = $request->maximo_horas;
            $obj->curso()->associate($objCurso);
            $this->repository->save($obj);
            return redirect()->route('categoria.index');
        }
        
        return view('message')
                ->with('template', "main")
                ->with('type', "danger")
                ->with('titulo', "OPERAÇÃO INVÁLIDA")
                ->with('message', "Não foi possível efetuar o procedimento!")
                ->with('link', "categoria.index");
    }

    public function destroy(string $id) {
        
        $this->authorize('hasFullPermission', Categoria::class);
        if($this->repository->delete($id))  {
            return redirect()->route('categoria.index');
        }
        
        return view('message')
                ->with('template', "main")
                ->with('type', "danger")
                ->with('titulo', "OPERAÇÃO INVÁLIDA")
                ->with('message', "Não foi possível efetuar o procedimento!")
                ->with('link', "categoria.index");
    }

    public function getCategoriesByCourse($value) {
        $data = $this->repository->findByColumn('curso_id', $value);
        return json_encode($data);
    }
}
