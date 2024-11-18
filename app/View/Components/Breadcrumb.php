<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public string $title;
    public string $subtitle;
    public ?string $background;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title = '', string $subtitle = '', ?string $background = null)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->background = $background ?? asset('https://poodies.candrawjy.my.id/assets/img/banner/banner-utama.png');
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
