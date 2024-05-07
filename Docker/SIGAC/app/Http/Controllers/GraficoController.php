<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AlunoRepository;
use App\Repositories\TurmaRepository;
use App\Repositories\DocumentoRepository;

class GraficoController extends Controller {

    private $curso_id;
    
    public function graphClass() {

        $turmas = (new TurmaRepository())->findByColumn('curso_id', Auth::user()->curso_id);
        
        $data = array();
        $cont = 0;
        foreach($turmas as $turma) {
            $data[$cont] = (new AlunoRepository())->selectHoursByClass($turma->id);
            $cont++;
        }
        
        // return $data;
        return view('grafico.aluno', compact('data'));
    }

    public function graphHour() {

        $turmas = (new TurmaRepository())->findByColumn('curso_id', Auth::user()->curso_id);
        
        $data = array();
        $cont = 0;
        foreach($turmas as $turma) {
            $data[$cont] = (new AlunoRepository())->getFulfillStudentsByClass($turma);
            $cont++;
        }
        
        // return $data;
        return view('grafico.hora', compact('data'));
    }
    
    // Apenas Exemplo - Material de Aula (método pode ser removido)
    public function test() {

        $data = json_encode([
            ["NOME", "TOTAL DE HORAS"],
            ["MARIA", 150],
            ["CARLOS", 90],
            ["JOÃO", 232],
            ["ANA", 197],
        ]);

        return view('grafico.exemplo', compact(['data'])); 
    }
}
