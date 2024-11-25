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
        $metaDescription = 'Discover the best food and restaurants with Robodeliver.',
        $metaAuthor = 'Robodeliver Inc.'
    ) {
        $this->title = $title;
        $this->metaDescription = $metaDescription;
        $this->metaAuthor = $metaAuthor;

        // Navigation for header
        $this->headerNavigation = [
            ['name' => 'Beranda', 'route' => 'home'],
            ['name' => 'Restoran', 'route' => 'merchants.home.index', 'children' => [
                ['name' => 'Pesan Makanan', 'route' => 'merchants.home.index'],
                ['name' => 'Daftar Sebagai Restoran', 'route' => 'merchant.register'],
            ]],
            ['name' => 'Tentang Kami', 'route' => 'about'],
            ['name' => 'Kontak', 'route' => 'contact'],
        ];

        // Navigation for footer
        $this->footerNavigation = [
            'quick_links' => [
                ['name' => 'Tentang Kami', 'route' => 'about'],
                ['name' => 'Daftarkan Restoran Anda', 'route' => 'merchant.register'],
                ['name' => 'FAQ & Bantuan', 'route' => 'help'],
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
