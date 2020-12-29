<?php

namespace App\View\Components;

use Illuminate\View\Component;

class grid-card extends Component
{
    /**
     * Color of the card
     *
     * @var string
     */

    public $color;

    /**
     * Title of the card
     *
     * @var string
     */

    public $title;

    /**
     * Content of the card
     *
     * @var string
     */

    public $content;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $content, $color)
    {
        $this->title = $title;
        $this->content = $content;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.grid-card');
    }
}
