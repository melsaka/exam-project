<?php

namespace Tests;

use Symfony\Component\HttpFoundation\Response as Status;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    protected function login($user = null): void
    {
        $user = $user ?: create(new User);
        Sanctum::actingAs($user);
    }

    protected function assertNotFound(String $class, TestResponse $response): void
    {
        $model = class_basename($class);

        $response->assertJson([
            "errors" => [
                "title" => "{$model} Not Found",
                "status" => Status::HTTP_NOT_FOUND,
            ]
        ]);

        $response->assertNotFound();
    }

    protected function assertJsonHave(Model $model, TestResponse $response): void
    {
        $resource = '\\App\\Http\\Resources\\' .class_basename($model) . 'Resource';

        $response->assertJsonFragment(
            ( new $resource($model) )->resolve()
        );
    }

    protected function assertValidationError($response)
    {
        return $response->assertStatus(422);
    }
}
