<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class Table extends Component
{
    protected $listeners = [
        'update-table' => '$refresh',
    ];

    public function getArticlesProperty()
    {
        return Article::all();
    }

    public function render()
    {
        return view('livewire.articles.table', [
            'articles' => $this->articles,
        ]);
    }

    public function set_article(int $id)
    {
        $this->emitTo('articles.form-article', 'set-article', $id);
    }
}
