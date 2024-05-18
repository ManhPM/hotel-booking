<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetDetailTest extends TestCase
{
    private $apiPrefix = '/api/v1/';
    private $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjQ2ZDg2OGMzYzJiZmI2M2MzM2RhNzk0MTZjNDNiMDQ2MTU0N2MzNDAzZGUzZTU5YjMzYjUzNTIzNTY5YTc4Y2IwZDY1YjNmMDBmZTYwZDkiLCJpYXQiOjE3MTU2MTcxOTUuMzQ5MDI3LCJuYmYiOjE3MTU2MTcxOTUuMzQ5MDMsImV4cCI6MTcxNjkxMzE5NS4zMzkxNjEsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.dq83Wp1-GCo8XsosPRY6Z8EJJ4mfuGTP6ku5qmSQFwbMkVCg9lHYmtE67hZlmX3OmOtB2a9ruhGRco7MMffu6u1YZuAcDfDJ7ZUupL0nU1Z2KF6Mn9-Abqa4sQptfEoTK80H-ytg8bhiL6WY7XSn_Ujn3N4cknqPygSzivIzbpVQU3PbRf01EhJ1WmthBxbBUUm-HIQMLA13qemwYSE9DavP01wkV5_arYuP_9NS05CQBIILAaMMvK-FUDf6BLhzRV8Ag7q3sRz4ELJr47HsVOZ8_gpftjmw3HPcCFGsVZAlkWCBysEb6L9MPZh-cKeHDa1aHv4G31Sf7olmkipD28MsaZ4qDZmrHBJ8quLajdSXdd2_DVYN8f13paMHYQ17V_79UX1-sm3wbPOF0u4rjhSxykSZxKlT8PAb-3MgZUUlqhqJzrXvAM8PWAlER3wowIQMJ0_c9hhaYGa4pZM8vRtVAZpDY6ZI6Z14hUMBVN9X9unDYU86ekHTqiKtsSEm_Pm5ye1TOCvZKhZahcCpeblLleERxVgFPu_TdNZIwzr9DIuQKycSwSAI9z8Xoq0Dooprzu4UHi1rRUVGB8mcgNUvYeZGZB3wY44Hlfpe0z54mBnyTO7PXbGBo4hxH-FlMSsfxoiKDI6eE16TKOh9frelX4y9kDhc13uSL3zDuKU';
    /** @test */
    public function user_can_get_detail_categories()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'categories/detail/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_get_detail_products()
    {
        $response = $this->get($this->apiPrefix . 'products/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_get_detail_coupons()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'coupons/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_get_detail_roles()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'roles/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_get_detail_orders()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'orders/detail/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_get_detail_users()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'users/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_get_profile()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'profile');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_get_detail_payment_methods()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'payment_methods/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_change_language()
    {
        $response = $this->get($this->apiPrefix . 'change_language?lang=VI');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_confirm_order()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'orders/confirm/1');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_cancel_order()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->get($this->apiPrefix . 'orders/cancel/2');
        $response->assertStatus(200);
    }
}
