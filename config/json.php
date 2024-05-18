<?php

return [
    'providers_list' => [
        [
            'reader' =>  \Plugins\FilesReader\Readers\JsonReaders\DataProviderXReader::class,
            'path' => storage_path('app/DataProvides'),
            'files' => ['DataProviderX.json'],
        ],

        [
            'reader' =>  \Plugins\FilesReader\Readers\JsonReaders\DataProviderYReader::class,
            'path' => storage_path('app/DataProvides'),
            'files' => ['DataProviderY.json'],
        ],
    ]
];
