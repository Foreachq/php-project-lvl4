<?php

namespace Tests\Feature\Http\Controllers\Unauthorized;

use App\Models\Label;
use Tests\TestCase;

class LabelControllerUnauthorizedTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Label::factory()
            ->state([
                'name' => 'testLabel'
            ])
            ->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();

        $response->assertDontSee(__('views.buttons.delete'));
        $response->assertDontSee(__('views.buttons.edit'));
        $response->assertDontSee(__('views.buttons.create'));

        $response->assertSee('testLabel');
    }

    public function testUpdate(): void
    {
        $response = $this->get(route('labels.edit', 1));
        $response->assertStatus(403);

        $response = $this->patch(route('labels.update', 1), [
            'name' => 'updatedLabel'
        ]);
        $response->assertStatus(403);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertStatus(403);

        $response = $this->post(route('labels.store'), [
            'name' => 'newLabel'
        ]);
        $response->assertStatus(403);
    }

    public function testDelete(): void
    {
        $response = $this->delete(route('labels.destroy', 1));
        $response->assertStatus(403);
    }
}
