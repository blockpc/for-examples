<?php

namespace App\Http\Livewire\Select2\Traits;

/**
 * Trait for Multiple / Parent Component Select2
 *
 * @package Blockpc\Select2Wire
 */
trait MultipleTagTrait
{
    public $tags = [];

    public function initializeMultipleTagTrait()
    {
        $this->listeners = array_merge($this->listeners, [
            'set-tag' => 'set_tag',
            'remove-tag' => 'remove_tag'
        ]);
    }

    public function set_tag(int $id)
    {
        $this->tags[] = $id;
    }

    public function remove_tag(int $id)
    {
        $this->tags = array_diff($this->tags, [$id]);
    }

    public function clean_tags()
    {
        $this->tags = [];
    }
}