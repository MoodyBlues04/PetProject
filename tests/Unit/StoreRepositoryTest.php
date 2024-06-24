<?php

namespace Tests\Unit;

use App\Models\Store;
use App\Repository\StoreRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private StoreRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new StoreRepository();
    }

    public function test_get_all(): void
    {
        $store = new Store([
            'name' => 'test_store',
            'email' => 'test@test.com',
            'description' => 'test'
        ]);
        $store->save();

        $expected = [$store];
        $actual = $this->repository->getAll();

        $this->assertSameSize($expected, $actual);
        $this->assertEquals($expected[0]->toArray(), $actual[0]->toArray());
    }
}
