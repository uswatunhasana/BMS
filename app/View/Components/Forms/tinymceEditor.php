<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class tinymceEditor extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('components.forms.tinymce-editor');
    }
}
