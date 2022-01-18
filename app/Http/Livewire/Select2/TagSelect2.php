<?php

declare(strict_types=1);

namespace App\Http\Livewire\Select2;

use Livewire\Component;
use App\Models\Tag;

/**
 * Multiple Select2 Component with parent model
 *
 * @package Blockpc\Select2Wire
 */
class TagSelect2 extends Component
{
    public $search;
    public $tags;

    protected $listeners = [
        'set-tags' => 'set_tags',
        'clear'
    ];

    public function mount()
    {
        $this->tags = collect([]);
    }

    public function getOptionsProperty()
    {
        return Tag::where('name', 'LIKE', "%{$this->search}%")->get();
    }

    public function render()
    {
        return view('livewire.select2.tag-select2', [
            'options' => $this->options,
        ]);
    }

    public function save()
    {
        $temporal = $this->parse_search();
        foreach( $temporal as $key => $name ) {
            $tag = Tag::firstOrCreate(['name' => $name]);
            if ( ! $this->tags->contains('id', $tag->id) ) {
                $this->tags->push($tag->only(['id', 'name']));
                $this->emitTo('articles.form-article', 'set-tag', $tag->id);
            }
        }
        $this->search = "";
    }

    public function select(Tag $tag)
    {
        if ( ! $this->tags->contains('id', $tag->id) ) {
            $this->tags->push($tag->only(['id', 'name']));
            $this->emitTo('articles.form-article', 'set-tag', $tag->id);
        }
    }

    public function remove(int $index)
    {
        $this->tags->forget($index);
        $this->emitTo('articles.form-article', 'remove-tag', $index);
    }

    /** listener */
    public function clear()
    {
        $this->tags = collect([]);
        $this->search = "";
    }

    /** listener */
    public function set_tags(array $tags)
    {
        // This $tags must be an array with ids of tags
        foreach ( $tags as $id ) {
            $tag = Tag::find($id);
            $this->tags->push($tag->only(['id', 'name']));
        }
    }

    private function parse_search()
    {
        $temporal = [];
        $temporal = explode(",", $this->search);
        $temporal = array_filter($temporal, 'strlen');
        $temporal = array_map('trim', $temporal);
        return $temporal;
    }
}