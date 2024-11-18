<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HomeLayout extends Component
{
    public $title;
    public $metaDescription;
    public $metaAuthor;
    public $headerNavigation;
    public $footerNavigation;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $metaDescription
     * @param string $metaAuthor
     */
    public function __construct(
        $title = 'Home',
        $metaDescription = 'Default Description',
        $metaAuthor = 'Robodeliver Inc.'
    ) {
        $this->title = $title;
        $this->metaDescription = $metaDescription;
        $this->metaAuthor = $metaAuthor;

        // Navigation for header
        $this->headerNavigation = [
            ['name' => 'Beranda', 'route' => 'home'],
            ['name' => 'Restoran', 'route' => '#', 'children' => [
                ['name' => 'Pesan Makanan', 'route' => 'order.food'],
                ['name' => 'Daftar Sebagai Restoran', 'route' => 'restaurant.add'],
            ]],
            ['name' => 'Tentang', 'route' => 'about'],
            ['name' => 'Kontak', 'route' => 'contact'],
        ];

        // Navigation for footer
        $this->footerNavigation = [
            'quick_links' => [
                ['name' => 'Tentang Kami', 'route' => 'about'],
                ['name' => 'Daftarkan Restoran Anda', 'route' => 'restaurant.add'],
                ['name' => 'FAQ & Bantuan', 'route' => 'help'],
            ],
            'categories' => [
                ['name' => 'Top Categories', 'route' => 'categories.top'],
                ['name' => 'Best Rated', 'route' => 'categories.best-rated'],
                ['name' => 'Best Price', 'route' => 'categories.best-price'],
                ['name' => 'Latest Submissions', 'route' => 'categories.latest'],
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('layouts.home');
    }
}
