<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Str;

class CreateUserTest extends TestCase
{
    protected Company $company;
    protected User $user;

    public function testCreateUser()
    {
        $this->createCompany();
        $this->assertNotNull($this->company);
        
        $this->createUser();
        $this->assertNotNull($this->user);

        $this->findUser();
    }

    public function findUser()
    {
        $finded = User::find($this->user->id);
        $this->assertNotNull($finded);
    }

    public function createUser()
    {
        $this->user = User::create([
            'name' => 'User test',
            'email' => Str::random(10)."@test.com",
            'password' => Hash::make('test'),
            'company_id' => $this->company->id,
            'access_granted' => true,
            'access_denied' => false,
        ]);
    }

    public function createCompany()
    {
        $this->company = Company::create([
            'name' => 'Test Company',
        ]);
    }
}
