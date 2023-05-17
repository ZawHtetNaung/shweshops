<?php

namespace App\View\Components;

use Illuminate\View\Component;

class wrappercomponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $divId;
    public $toshowId;

    public function __construct($divId,$toshowId) {
        $this->divId=$divId;
        $this->toshowId=$toshowId;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.wrappercomponent');
    }
}
