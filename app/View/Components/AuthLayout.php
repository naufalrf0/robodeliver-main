<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthLayout extends Component
{
    public $title;
    public $metaDescription;
    public $metaAuthor;

    /**
     * Create a new component instance.
     *
     * @param string|null $title
     * @param string|null $metaDescription
     * @param string|null $metaAuthor
     */
    public function __construct(
        $title = null,
        $metaDescription = null,
        $metaAuthor = null
    ) {
        $this->title = $title;
        $this->metaDescription = $metaDescription;
        $this->metaAuthor = $metaAuthor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('layouts.auth');
    }
}
