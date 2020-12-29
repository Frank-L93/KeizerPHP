<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Accordion extends Component
{
    /**
     * The accordion item id
     *
     * @var integer
     */

    public $accordionID;
    /**
     * The accordion item title
     *
     * @var string
     */
    public $title;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($accordionID, $title)
    {
        $this->accordionID = $accordionID;
        $this->title = $title;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.accordion');
    }
}
