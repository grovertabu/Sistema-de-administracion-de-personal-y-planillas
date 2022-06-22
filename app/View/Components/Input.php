<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $type, $id, $name, $label, $placeholder;
    public $topclass, $inputclass;
    public $value, $disabled, $required, $readonly;
    public $step, $max, $maxlength, $min;

    public function __construct(
            $type = 'text', $id = null, $name = null,
            $label = 'Input Label', $placeholder = null,
            $topclass = null, $inputclass = null,
            $value = null, $disabled = false, $required = false, $readonly = false,
            $step = null, $max = null, $maxlength = null, $min = null
        )
    {
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->topclass = $topclass;
        $this->inputclass = $inputclass;
        $this->value = $value;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->step = $step;
        $this->max = $max;
        $this->maxlength = $maxlength;
        $this->min = $min;
    }

    public function render()
    {
        return view('components.input');
    }
}
