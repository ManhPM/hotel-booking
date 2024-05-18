<?php

namespace Tests\Feature;

use App\Models\CartProduct;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    private $apiPrefix = '/api/v1/';
    private $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzZkNTEwMTA1NTBjNjAyYTg1ZWEwZmQ4NzZiNjJiZmE2ZWJkZGY1Nzc0ODQ2ZWU3ZjI4YzM2MzUyNzM0MmU5YTUxMDZlOWQzZmIyNTlmMGUiLCJpYXQiOjE3MTU3MzkwNzIuNTMzMTU5LCJuYmYiOjE3MTU3MzkwNzIuNTMzMTY4LCJleHAiOjE3MTcwMzUwNzIuNTE5NzIzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EnRqvichzP62-UAMiLynN5NumiQLevyw1u3H3fAuttnQtwwi-_4EJuDw12cqbC_9x-sdFw3OSazrr9H0Kc_yEXJw2E-_axHJm4BTGxsmdoVXlR9iWS3AcmXTKcNh8-FJ-gK6ghcCBSNyunpno39nOMk9pbhJMSw5HkK-kxxYw2_j2wTgf7r80xGEA-NbqC3bsPHk1bY2NqbT6NDPOjJJyS4-NHl4Y88pJathvBIR-v0QHh1DzHorAkwFQIguwZI-hg6xiLewCXtxWyDYgpIn3OaCBhaRKU44VG-TKFveIHEjtj0j-KwhPgGEtOOK1-tWYDSBAvA2-8zZVrCpMN5c5C9T2NjnLM9QRspi8qU5U4Iv7i9gs0u31XtK4tJC0hE0HaMeoKsX9kDQwQIv-hF1u5811tYuzUtkQD_9_Zr3DtNq-eWXTNSwPlOgQ25VdGuLrupXAjeVYYkKMUquzRpxFV2hCq319fG36q16ZS0Y_HJs0DCmrHrOCxE5QUrVpwQW1PvZy7ptdmJ2zRPse-zR8TEPxGab4X3ys9JQFkFn_i1rPi2tW04pK7oXR1T9KyHMi_Xm8oGT2SC5ZPwrSj4M2F8iRWYElqMmiSplzq0XHolfv6SS10SVaJeIviC_pg0lKvc0kmXSPDGcYDu4xRdtk7hJh_cifl15P3azjmouX9s';
    /** @test */
    public function user_can_update_role()
    {
        $dataCreate = [
            "name" => "Updated",
            "display_name" => "TEST",
            "group" => "system",
            "permission_ids" => [21, 22]
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'roles/6', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_profile()
    {
        $dataCreate = [
            "name" => "TESTTT",
            "phone" => "0222222227",
            "password" => "123456",
            "email" => "phammanhbeo2001@gmail.com",
            "image" => "https://i.pinimg.com/564x/24/21/85/242185eaef43192fc3f9646932fe3b46.jpg"
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'profile', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_user()
    {
        $dataCreate = [
            "name" => "TESTTT",
            "phone" => "0222222224",
            "password" => "123456",
            "email" => "phammanhbeo2001@gmail.com",
            "role_ids" => [1, 2, 3, 4, 5]
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'users/1', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_category()
    {
        $dataCreate = [
            "name" => "TESTTTTT",
            "parent_id" => 2
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'categories/10', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_product()
    {
        $dataCreate = [
            "name" => "Test update",
            "price" => 1000000,
            "description" => "Mô tả sản phẩm",
            "image" => "https://giaycaosmartmen.com/wp-content/uploads/2020/12/cach-chup-giay-dep-5.jpg",
            "category_ids" => [1, 4],
            "sizes" => [
                [
                    "size" => "39",
                    "quantity" => 10,
                    "product_id" => 5
                ],
                [
                    "size" => "44",
                    "quantity" => 15,
                    "product_id" => 10
                ],
                [
                    "size" => "41",
                    "quantity" => 20,
                    "product_id" => 15
                ]
            ]
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'products/22', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_coupon()
    {
        $dataCreate = [
            "name" => "Updated",
            "type" => "Test",
            "value" => 12,
            "expire_date" => "2024-06-06"
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'coupons/7', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_payment_method()
    {
        $dataCreate = [
            "name" => "Updated",
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'payment_methods/3', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_update_cart_product()
    {
        $dataCreate = [
            "product_size" => 40,
            "product_quantity" => 20,
            "product_id" => 9
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'cart_update', $dataCreate);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_cart_product()
    {
        $dataCreate['cart_id'] = 1;
        $dataCreate['product_size'] = '40';
        $dataCreate['product_quantity'] = '10';
        $dataCreate['product_price'] = 1000000;
        $dataCreate['product_id'] = 3;
        CartProduct::create($dataCreate);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->put($this->apiPrefix . 'cart_delete', $dataCreate);
        $response->assertStatus(200);
    }
}
