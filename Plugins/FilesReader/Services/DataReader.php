<?php

namespace Plugins\FilesReader\Services;

use Plugins\FilesReader\Events\ReadDataEvent;

class DataReader
{
    public function execute()
    {
        $providers_list = config('json.providers_list');
        foreach ($providers_list as $provider) {
            
            $path = $provider['path'] ?? null;
            $reader = $provider['reader'] ?? null;
            $files = $provider['files'] ?? [];
            
            if ($path && file_exists($path) && $reader && class_exists($reader)) {

                foreach ($files as $file) {
                    $filepath = $path . '/' . $file;
                    if (file_exists($filepath)) {
                        // (new $reader)->read($filepath);
                        ReadDataEvent::dispatch(new $reader, $filepath);
                    }
                }
            }
        }
    }
}
