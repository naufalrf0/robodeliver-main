<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    public $title;
    public $metaDescription;
    public $metaAuthor;

    public function __construct($title = 'Home', $metaDescription = 'Default Description', $metaAuthor = 'Robodeliver Inc.')
    {
        $this->title = $title;
        $this->metaDescription = $metaDescription;
        $this->metaAuthor = $metaAuthor;
    }

    public function render()
    {
        return view('layouts.admin');
    }
}
