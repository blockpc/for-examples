<?php

namespace App\Http\Livewire\Articles;

use App\Http\Livewire\Select2\Traits\MultipleTagTrait;
use App\Http\Livewire\Select2\Traits\SingleCategoryTrait;
use App\Models\Article;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FormArticle extends Component
{
    use SingleCategoryTrait, MultipleTagTrait;

    protected $listeners = [
        'set-article' => 'set_article',
        'close' => 'cancel',
        'new',
    ];

    public Article $article;

    public function mount()
    {
        $this->article = new Article;
    }

    public function render()
    {
        return view('livewire.articles.form-article');
    }

    public function save()
    {
        $this->validate();
        $this->article->save();
        if ( count($this->tags) ) {
            $this->article->tags()->sync($this->tags);
        }
        $this->new();
        $this->emit('update-table');
        $this->dispatchBrowserEvent('close-form-article');
    }

    protected function rules()
    {
        $rule_unique = $this->article->exists
            ? Rule::unique('articles', 'title')->ignore($this->article)
            : Rule::unique('articles', 'title');
        return [
            'article.title' => ['required', 'string', 'max:64', $rule_unique],
            'article.content' => ['required', 'string', 'max:255'],
            'article.category_id' => ['required', 'exists:categories,id'],
        ];
    }

    // listener from article.table
    public function set_article(Article $article)
    {
        $this->article = $article;
        $this->tags = $this->article->tags->map(function ($tag) {
            return $tag->id;
        })->all();
        $this->emitTo('select2.category-select2', 'set-category', $this->article->category->id);
        $this->emitTo('select2.tag-select2', 'set-tags', $this->tags);
    }

    // listener general
    public function cancel()
    {
        $this->resetErrorBag();
        $this->article = new Article;
        $this->clean_tags();
        $this->emitTo('select2.category-select2', 'clear');
        $this->emitTo('select2.tag-select2', 'clear');
        $this->dispatchBrowserEvent('close-form-article');
    }

    // listener general
    public function new()
    {
        $this->resetErrorBag();
        $this->article = new Article;
        $this->clean_tags();
        $this->emitTo('select2.category-select2', 'clear');
        $this->emitTo('select2.tag-select2', 'clear');
    }
}
