<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;

class Articles extends Component
{
    public function render()
    {
        return view('livewire.blog.articles')
            ->layout('layouts.app', ['header' => 'Articles']);
    }
}
