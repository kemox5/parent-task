<?php

namespace Plugins\FilesReader\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Modules\UsersModule\Models\Order;
use Plugins\FilesReader\Services\DataReader;
use Plugins\FilesReader\Tests\Factories\JsonGenerator;
use Tests\TestCase;

class PluginTest extends TestCase
{
    use RefreshDatabase;
    
    public function testDataProviderXReader()
    {
        (new JsonGenerator)->generateLargeJsonFile('x', 'DataProviderX.json', 5000);

        Config::set('json.providers_list', [
            [
                'reader' =>  \Plugins\FilesReader\Readers\JsonReaders\DataProviderXReader::class,
                'path' => storage_path('app/test'),
                'files' => ['DataProviderX.json'],
            ]
        ]);

        $reader = new DataReader();
        $reader->execute();

        $this->assertEquals(Order::count(), 5000);
    }

    public function testDataProviderYReader()
    {
        (new JsonGenerator)->generateLargeJsonFile('y', 'DataProviderY.json', 5000);

        Config::set('json.providers_list', [
            [
                'reader' =>  \Plugins\FilesReader\Readers\JsonReaders\DataProviderYReader::class,
                'path' => storage_path('app/test'),
                'files' => ['DataProviderY.json'],
            ]
        ]);

        $reader = new DataReader();
        $reader->execute();

        $this->assertEquals(Order::count(), 5000);
    }
}
