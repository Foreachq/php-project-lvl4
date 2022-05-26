<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testLang(): void
    {
        $this->withCookie('lang', 'en');
        $response = $this->get(route('home'));

        $response->assertSee(__('views.task.title', [], 'en'));

        $this->withCookie('lang', 'ru');
        $response = $this->get(route('home'));

        $response->assertSee(__('views.task.title', [], 'ru'));
    }
}
