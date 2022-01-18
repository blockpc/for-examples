<?php

namespace App\Http\Livewire\Select2\Traits;

/**
 * Trait for Single / Parent Component Select2
 *
 * @package Blockpc\Select2Wire
 */
trait SingleCategoryTrait
{
    public function initializeSingleCategoryTrait()
    {
        $this->listeners = array_merge($this->listeners, [
            'set-category' => 'set_category'
        ]);
    }

    public function set_category(int $id)
    {
        $this->article->category_id = $id;
    }
}