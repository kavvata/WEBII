<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class Datatable extends Component
{
    public $title;
    public $header;
    public $crud;
    public $dados;
    public $fields;
    public $hide;
    public $remove;
    public $create;
    public $id;
    public $modal;

    public function __construct($title, $header, $crud, $dados, $fields, $hide, $remove, $create, $id, $modal)
    {
        $this->title = $title;
        $this->header = $header;
        $this->crud = $crud;
        $this->fields = $fields;
        $this->hide = $hide;
        $this->remove = $remove;
        $this->create = $create;
        $this->id = $id;
        $this->modal = $modal;
        $this->dados = $dados;
    }

    public function render(): View|Closure|string
    {
        return view('components.datatable');
    }
}
