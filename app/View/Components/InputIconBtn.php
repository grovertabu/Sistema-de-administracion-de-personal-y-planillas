<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputIconBtn extends Component
{
    public $type, $id, $name, $label, $placeholder, $idbutton;
    public $topclass, $inputclass;
    public $value, $disabled, $required;
    public $step, $max, $maxlength, $pattern, $icon;

    public function __construct(
            $type = 'text', $id = null, $name = null,
            $label = 'Input Label', $placeholder = null,
            $topclass = null, $inputclass = null,
            $value = null, $disabled = false, $required = false,
            $step = null, $max = null, $maxlength = null, $pattern = null, $icon=null,
            $idbutton =null
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
        $this->disabled = $disabled;
        $this->step = $step;
        $this->max = $max;
        $this->maxlength = $maxlength;
        $this->pattern = $pattern;
        $this->icon = $icon;
        $this->idbutton= $idbutton;
    }
    public function render()
    {
        return view('components.input-icon-btn');
    }
}
