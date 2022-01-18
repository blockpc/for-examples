<?php

declare(strict_types=1);

namespace App\Http\Livewire\Select2;

use Livewire\Component;
use App\Models\Category;

/**
 * Single Select2 Component with parent model
 *
 * @package Blockpc\Select2Wire
 */
class CategorySelect2 extends Component
{
    public Category $category;

    public $search;

    protected $listeners = [
        'set-category' => 'set_category',
        'clear'
    ];

    public function mount()
    {
        $this->category = new Category;
    }

    public function getOptionsProperty()
    {
        return Category::where('name', 'LIKE', "%{$this->search}%")->get();
    }

    public function render()
    {
        return view('livewire.select2.category-select2', [
            'options' => $this->options,
        ]);
    }

    public function save()
    {
        $this->category = Category::firstOrCreate(['name' => $this->search]);
        $this->search = "";
        $this->emitTo('articles.form-article', 'set-category', $this->category->id);
    }

    public function select(Category $category)
    {
        $this->category = $category;
        $this->emitTo('articles.form-article', 'set-category', $category->id);
    }

    /** listener */
    public function clear()
    {
        $this->category = new Category;
        $this->reset('search');
    }

    /** listener */
    public function set_category(Category $category)
    {
        $this->category = $category;
    }
}