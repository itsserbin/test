<?php

namespace Feature\Models;

use App\Models\Characteristic;
use Tests\TestCase;

class CharacteristicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    final public function test_characteristic_can_be_created(): void
    {
        // Create a new characteristic using the factory
        $item = Characteristic::factory()->create();

        // Assert that the characteristic was created successfully
        $this->assertDatabaseHas('characteristics', [
            'id' => $item->id,
        ]);
    }

}
