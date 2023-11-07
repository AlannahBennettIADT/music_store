<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SongCover extends Component
{
    public $type;
    public $name;
    public $class;
    public $placeholder;

    public function __construct($type, $name, $class, $placeholder)
    {
        $this->type = $type;
        $this->name = $name;
        $this->class = $class;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.file-input');
    }
}

