<?php

namespace Tests\Feature;

use App\Models\Company;
use Tests\TestCase;
use Database\Seeders\CompanySeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class CompanyControllerTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_index_return_one_company(){

        $company = Company::factory()->create();

        $response = $this->get('api/company/' . $company->id, ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertEquals($company->toArray(), $response->json()[0]);
    }

    public function test_index_return_multiple_company(){

        $companies = Company::factory(5)->create();
        $ids = $companies->take(3)->pluck('id')->toArray();

        $this->assertCount(3, $ids);

        $selectedCompanies = Company::whereIn('id', $ids)->get();

        $response = $this->get('api/company/' . implode(',', $ids), ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertEquals($selectedCompanies->toArray(), $response->json());
    }

    public function test_store_company_can_be_saved(){

        $company = Company::factory()->make()->toArray();
        $response = $this->post('api/company', $company, ['Accept' => 'application/json']);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'message' => 'The new company has been added successfully.'
        ]);
    }

    public function test_store_company_can_be_updated(){

        $company = Company::factory()->create()->toArray();

        $company['name'] = fake()->name();
        $company['employees'] = fake()->numberBetween(10, 66);

        $response = $this->patch('api/company/' . $company['id'], $company, ['Accept' => 'application/json']);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'message' => 'The company has been updated successfully.'
        ]);

        $companyUpdated = Company::find($company['id'])->toArray();
        $this->assertEquals($companyUpdated, $company);
    }
}
