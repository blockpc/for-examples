<?php

namespace App\Http\Livewire\Select2\Traits;

/**
 * Trait for Single / Parent Component Select2
 *
 * @package Blockpc\Select2Wire
 */
trait SingleBrandTrait
{
    public function initializeSingleBrandTrait()
    {
        $this->listeners = array_merge($this->listeners, [
            'set-brand' => 'set_brand'
        ]);
    }

    public function set_brand(int $id)
    {
        $this->vehicle->brand_id = $id;
    }
}