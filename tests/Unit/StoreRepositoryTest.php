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
            'description' => 'test1'
        ]);
        $store->save();

        $expected = [$store];
        $actual = $this->repository->getAll();

        $this->assertSameSize($expected, $actual);
        $this->assertEquals($expected[0]->toArray(), $actual[0]->toArray());
    }

    public function test_get_by(): void
    {
        $propsList = [
            [
                'name' => 'test_store',
                'email' => 'test@test.com',
                'description' => 'test'
            ],
            [
                'name' => 'test_store1',
                'email' => 'test1@test.com',
                'description' => 'test'
            ],
        ];
        $models = array_map(function (array $props) {
            $store = new Store($props);
            $store->save();
            return $store;
        }, $propsList);

        $cond = ['description' => 'test'];
        $expected = $models[0];
        $actual = $this->repository->getFirstBy($cond);
        $actualArr = $this->repository->getAllBy($cond);

        $this->assertEquals($expected->toArray(), $actual->toArray());
        $this->assertSameSize($models, $actualArr);
        $this->assertEquals(
            array_map(fn($store) => $store->toArray(), $models),
            array_map(fn($store) => $store->toArray(), $actualArr));
    }

    public function test_create(): void
    {
        $store = $this->repository->create([
            'name' => 'test_store',
            'email' => 'test@test.com',
            'description' => 'test'
        ]);
        $this->assertNotNull($store);
        $this->assertTrue(Store::query()->where('id', $store->id)->exists());
    }
}
