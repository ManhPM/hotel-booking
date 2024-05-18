<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateTest extends TestCase
{
    private $apiPrefix = '/api/v1/';
    private $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzZkNTEwMTA1NTBjNjAyYTg1ZWEwZmQ4NzZiNjJiZmE2ZWJkZGY1Nzc0ODQ2ZWU3ZjI4YzM2MzUyNzM0MmU5YTUxMDZlOWQzZmIyNTlmMGUiLCJpYXQiOjE3MTU3MzkwNzIuNTMzMTU5LCJuYmYiOjE3MTU3MzkwNzIuNTMzMTY4LCJleHAiOjE3MTcwMzUwNzIuNTE5NzIzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EnRqvichzP62-UAMiLynN5NumiQLevyw1u3H3fAuttnQtwwi-_4EJuDw12cqbC_9x-sdFw3OSazrr9H0Kc_yEXJw2E-_axHJm4BTGxsmdoVXlR9iWS3AcmXTKcNh8-FJ-gK6ghcCBSNyunpno39nOMk9pbhJMSw5HkK-kxxYw2_j2wTgf7r80xGEA-NbqC3bsPHk1bY2NqbT6NDPOjJJyS4-NHl4Y88pJathvBIR-v0QHh1DzHorAkwFQIguwZI-hg6xiLewCXtxWyDYgpIn3OaCBhaRKU44VG-TKFveIHEjtj0j-KwhPgGEtOOK1-tWYDSBAvA2-8zZVrCpMN5c5C9T2NjnLM9QRspi8qU5U4Iv7i9gs0u31XtK4tJC0hE0HaMeoKsX9kDQwQIv-hF1u5811tYuzUtkQD_9_Zr3DtNq-eWXTNSwPlOgQ25VdGuLrupXAjeVYYkKMUquzRpxFV2hCq319fG36q16ZS0Y_HJs0DCmrHrOCxE5QUrVpwQW1PvZy7ptdmJ2zRPse-zR8TEPxGab4X3ys9JQFkFn_i1rPi2tW04pK7oXR1T9KyHMi_Xm8oGT2SC5ZPwrSj4M2F8iRWYElqMmiSplzq0XHolfv6SS10SVaJeIviC_pg0lKvc0kmXSPDGcYDu4xRdtk7hJh_cifl15P3azjmouX9s';
    /** @test */
    public function user_can_create_role()
    {
        $dataCreate = [
            'name' => 'TESTTT',
            'display_name' => 'TEST',
            'group' => 'system',
            'permission_ids' => ['21', '22']
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'roles', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_register()
    {
        $dataCreate = [
            "name" => "TESTTT",
            "phone" => "0221125223",
            "password" => "123456",
            "email" => "CREA13E@gmail.com",
            "image" => "https://i.pinimg.com/564x/24/21/85/242185eaef43192fc3f9646932fe3b46.jpg"
        ];

        $response = $this->post($this->apiPrefix . 'login', $dataCreate);

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_login()
    {
        $dataCreate = [
            "email" => "phammanhbeo2001@gmail.com",
            "password" => "123456"
        ];

        $response = $this->post($this->apiPrefix . 'login', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_forgot_password()
    {
        $dataCreate = [
            "email" => "phammanhbeo2001@gmail.com",
        ];

        $response = $this->post($this->apiPrefix . 'forgot_password', $dataCreate);
        $response->assertStatus(200);
    }



    public function user_can_reset_password()
    {
        $dataCreate = [
            "email" => "phammanhbeo2001@gmail.com",
            "token" => "234716",
            "password" => "123456",
            "password_confirmation" => "123456"
        ];

        $response = $this->post($this->apiPrefix . 'forgot_password', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_user()
    {
        $dataCreate = [
            "name" => "TESTTT",
            "phone" => "0123456781",
            "password" => "000000",
            "email" => "CREATc@gmail.com",
            "image" => "https://i.pinimg.com/564x/24/21/85/242185eaef43192fc3f9646932fe3b46.jpg",
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'users', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_category()
    {
        $dataCreate = [
            "name" => "TESTTTTT",
            "parent_id" => 1
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'categories', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_product()
    {
        $dataCreate = [
            "name" => "TesTTTt",
            "price" => 1000000,
            "description" => "Mô tả sản phẩm",
            "category_ids" => [1, 6],
            "image" => "https://giaycaosmartmen.com/wp-content/uploads/2020/12/cach-chup-giay-dep-5.jpg",
            "sizes" => [
                [
                    "size" => "39",
                    "quantity" => 10,
                    "product_id" => 1
                ],
                [
                    "size" => "44",
                    "quantity" => 15,
                    "product_id" => 1
                ],
                [
                    "size" => "41",
                    "quantity" => 20,
                    "product_id" => 1
                ]
            ]
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'products', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_coupon()
    {
        $dataCreate = [
            "name" => "TESTTT",
            "type" => "Test",
            "value" => 12,
            "expire_date" => "2024-06-06"
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'coupons', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_payment_method()
    {
        $dataCreate = [
            "name" => "TESTTT",
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'payment_methods', $dataCreate);
        $response->assertStatus(200);
    }

    public function user_can_add_to_cart()
    {
        $dataCreate = [
            "product_size" => 43,
            "product_quantity" => 1,
            "product_id" => 4
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'cart_add', $dataCreate);
        $response->assertStatus(200);
    }

    public function user_can_checkout()
    {
        $dataCreate = [
            "code" => "SALE05"
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->post($this->apiPrefix . 'checkout', $dataCreate);
        $response->assertStatus(200);
    }
}
