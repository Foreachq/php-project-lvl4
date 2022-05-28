<?php

namespace Tests\Feature\Http\Controllers\Authorized;

use App\Models\Label;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LabelControllerAuthorizedTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Label::factory()
            ->state([
                'name' => 'testLabel'
            ])
            ->create();

        $user = User::factory()->create();
        Auth::login($user);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();

        $response->assertSee(__('views.buttons.delete'));
        $response->assertSee(__('views.buttons.edit'));
        $response->assertSee(__('views.buttons.create'));

        $response->assertSee('testLabel');
    }

    public function testUpdate(): void
    {
        $response = $this->get(route('labels.edit', 1));
        $response->assertOk();

        $this->patch(route('labels.update', 1), [
            'name' => 'updatedLabel'
        ]);
        $response->assertOk();

        $label = Label::where('id', 1)->get()->first();
        $this->assertEquals('updatedLabel', $label->name);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();

        $response = $this->post(route('labels.store'), [
            'name' => 'newLabel'
        ]);
        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', [
            'name' => 'newLabel'
        ]);
    }

    public function testDelete(): void
    {
        $response = $this->delete(route('labels.destroy', 1));
        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing('labels', [
            'name' => 'testLabel'
        ]);
    }
}
