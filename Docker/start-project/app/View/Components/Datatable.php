<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datatable extends Component {

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

    public function __construct($title, $header, $crud, $dados, $fields, $hide, $remove, $create, $id, $modal) {

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

    public function render() {
        return view('components.datatable');
    }
}