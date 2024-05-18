<?php

namespace Tests\Feature;

use App\Models\CartProduct;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    private $apiPrefix = '/api/v1/';
    private $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzZkNTEwMTA1NTBjNjAyYTg1ZWEwZmQ4NzZiNjJiZmE2ZWJkZGY1Nzc0ODQ2ZWU3ZjI4YzM2MzUyNzM0MmU5YTUxMDZlOWQzZmIyNTlmMGUiLCJpYXQiOjE3MTU3MzkwNzIuNTMzMTU5LCJuYmYiOjE3MTU3MzkwNzIuNTMzMTY4LCJleHAiOjE3MTcwMzUwNzIuNTE5NzIzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.EnRqvichzP62-UAMiLynN5NumiQLevyw1u3H3fAuttnQtwwi-_4EJuDw12cqbC_9x-sdFw3OSazrr9H0Kc_yEXJw2E-_axHJm4BTGxsmdoVXlR9iWS3AcmXTKcNh8-FJ-gK6ghcCBSNyunpno39nOMk9pbhJMSw5HkK-kxxYw2_j2wTgf7r80xGEA-NbqC3bsPHk1bY2NqbT6NDPOjJJyS4-NHl4Y88pJathvBIR-v0QHh1DzHorAkwFQIguwZI-hg6xiLewCXtxWyDYgpIn3OaCBhaRKU44VG-TKFveIHEjtj0j-KwhPgGEtOOK1-tWYDSBAvA2-8zZVrCpMN5c5C9T2NjnLM9QRspi8qU5U4Iv7i9gs0u31XtK4tJC0hE0HaMeoKsX9kDQwQIv-hF1u5811tYuzUtkQD_9_Zr3DtNq-eWXTNSwPlOgQ25VdGuLrupXAjeVYYkKMUquzRpxFV2hCq319fG36q16ZS0Y_HJs0DCmrHrOCxE5QUrVpwQW1PvZy7ptdmJ2zRPse-zR8TEPxGab4X3ys9JQFkFn_i1rPi2tW04pK7oXR1T9KyHMi_Xm8oGT2SC5ZPwrSj4M2F8iRWYElqMmiSplzq0XHolfv6SS10SVaJeIviC_pg0lKvc0kmXSPDGcYDu4xRdtk7hJh_cifl15P3azjmouX9s';
    /** @test */
    public function user_can_delete_role()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->delete($this->apiPrefix . 'roles/6');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->delete($this->apiPrefix . 'users/3');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_category()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->delete($this->apiPrefix . 'categories/10');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->delete($this->apiPrefix . 'products/22');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_coupon()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->delete($this->apiPrefix . 'coupons/7');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_payment_method()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token,
        ])->delete($this->apiPrefix . 'payment_methods/3');
        $response->assertStatus(200);
    }
}
