<?php

namespace Modules\UsersModule\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UsersModule\Models\Order;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;
    private $list_users_api = 'api/v1/users';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_api_200()
    {
        $response = $this->get($this->list_users_api);
        $response->assertStatus(200);
    }

    public function test_validation_valid_request_with_all_filters()
    {
        $data = [
            'provider' => 'DataProviderY',
            'statusCode' => 'authorised',
            'balanceMin' => '1',
            'balanceMax' => '10',
            'currency' => 'USD',
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(200);
    }

    public function test_validation_invalid_provider()
    {
        $data = [
            'provider' => 'invalid'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(422);
        $response->assertJsonStructure(["errors" => ["provider"], "success"]);
    }

    public function test_validation_invalid_statusCode()
    {
        $data = [
            'statusCode' => 'invalid'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(422);
        $response->assertJsonStructure(["errors" => ["statusCode"], "success"]);
    }

    public function test_validation_invalid_currency()
    {
        $data = [
            'currency' => 'invalid'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(422);
        $response->assertJsonStructure(["errors" => ["currency"], "success"]);
    }

    public function test_validation_invalid_balanceMin()
    {
        $data = [
            'balanceMin' => 'invalid'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(422);
        $response->assertJsonStructure(["errors" => ["balanceMin"], "success"]);
    }

    public function test_validation_invalid_balanceMax()
    {
        $data = [
            'balanceMax' => 'invalid'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(422);
        $response->assertJsonStructure(["errors" => ["balanceMax"], "success"]);
    }

    public function test_validation_invalid_balanceMax_smaller_than_balanceMin()
    {
        $data = [
            'balanceMin' => '10',
            'balanceMax' => '1',
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(422);
        $response->assertJsonStructure(["errors" => ["balanceMax"], "success"]);
    }


    public function test_currency_filter()
    {
        Order::factory(2)->create([
            'currency' => 'SAR'
        ]);
        Order::factory(4)->create([
            'currency' => 'USD'
        ]);

        $data = [
            'currency' => 'USD'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertJsonCount(4, "users");
    }

    public function test_statusCode_filter()
    {
        Order::factory(2)->create([
            'status_code' => '100'
        ]);
        Order::factory(4)->create([
            'status_code' => '200'
        ]);

        $data = [
            'statusCode' => 'authorised'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertJsonCount(2, "users");
    }

    public function test_source_filter()
    {
        Order::factory(2)->create([
            'source' => 'DataProviderX'
        ]);
        Order::factory(3)->create([
            'source' => 'DataProviderY'
        ]);

        $data = [
            'provider' => 'DataProviderX'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertJsonCount(2, "users");
    }

    public function test_amount_filter()
    {
        Order::factory(2)->create([
            'amount' => rand(1, 200)
        ]);
        Order::factory(20)->create([
            'amount' => rand(300, 500)
        ]);

        $data = [
            'balanceMin' => '299',
            'balanceMax' => '501'
        ];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertJsonCount(20, "users");
    }

    public function test_email_distinct()
    {
        Order::factory(20)->create([
            'email' => 'karim@app.com'
        ]);

        $data = [];
        $url = $this->list_users_api . '?' . http_build_query($data);
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertJsonCount(1, "users");
    }
}
