<?php

namespace App\View\Components;

use Illuminate\View\Component;

class button extends Component
{
    /**
     * The button type
     *
     * @var string
     */
    public $type;

    /**
     * The button value
     *
     * @var string
     */
    public $value;

    /**
     * The button name
     *
     * @var string
     */
    public $name;

    /**
     * The button success or error
     *
     * @var string
     */
    public $success;

    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $value, $success)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->success = $success;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}
