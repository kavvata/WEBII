@extends('templates.main', ['titulo' => 'Niveis'])

@section('conteudo')
<h1>Nivel - index</h1>
    <x-datatable 
        title="Tabela de Níveis de Ensino" 
        :header="['ID', 'Nome', 'Ações']" 
        crud="nivel" 
        :dados="$data"
        :fields="['id', 'nome']" 
        :hide="[true, false, false]"
        remove="nome"
        create="nivel.create"
        id="" 
        modal=""
    /> 

@endsection