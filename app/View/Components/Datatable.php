<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datatable extends Component
{
    public $beautify, $buttons;
    public $id;
    public $bordered, $hoverable, $condensed;
    public $heads, $footer;

    public function __construct(
        $beautify = true, $id,
        $bordered = true, $hoverable = true, $condensed = false,
        $heads, $footer = false, $buttons = false
        )
    {
        $this->id = $id;
        $this->beautify = $beautify;
        $this->bordered = $bordered;
        $this->hoverable = $hoverable;
        $this->condensed = $condensed;
        $this->heads = json_decode(json_encode($heads));
        $this->footer = $footer;
        $this->buttons = $buttons;
    }

    public function border()
    {
        return ($this->bordered) ? 'table-bordered' : null;
    }

    public function hover()
    {
        return ($this->hoverable) ? 'table-hover' : null;
    }

    public function condense()
    {
        return ($this->condensed) ? 'table-condensed' : null;
    }
    public function render()
    {
        return view('components.datatable');
    }
}
