<?php

namespace Plugins\FilesReader\Tests\Factories;

use Plugins\FilesReader\Tests\Factories\DataProviderXFactory;

/* 
{
    parentAmount:200,
    Currency:'USD',
    parentEmail:'parent1@parent.eu',
    statusCode:1,
    registerationDate: '2018-11-30',
    parentIdentification: 'd3d29d70-1d25-11e3-8591-034165a3a613'
}
*/

class JsonGenerator
{
    public static function generateLargeJsonFile($factoy, $filename = 'DataProviderX.json', $numRecords = 1000)
    {
        $file = fopen('/var/www/storage/app/test/' . $filename, 'w');

        // Start JSON array enclosure
        fwrite($file, '[');

        for ($i = 0; $i < $numRecords; $i++) {

            // Generate random data
            $balance = rand(100, 1000);
            $currency = ['AED', 'USD', 'EUR'][array_rand(['AED', 'USD', 'EUR'])];
            $email = "parent" . ($i + 1) . "@parent.eu";
            $id = uniqid();

            switch ($factoy) {

                case 'x':
                    $status = ['1', '2', '3'][array_rand(['1', '2', '3'])];
                    $createdAt = date("Y-m-d", strtotime("-" . rand(0, 365) . " days"));
                    // Create data array
                    $data = [
                        'parentAmount' => $balance,
                        'Currency' => $currency,
                        'parentEmail' => $email,
                        'statusCode' => $status,
                        'registerationDate' => $createdAt,
                        'parentIdentification' => $id,
                    ];
                    break;

                default:
                    $status = ['100', '200', '300'][array_rand(['100', '200', '300'])];
                    $createdAt = date("d/m/Y", strtotime("-" . rand(0, 365) . " days"));
                    // Create data array
                    $data = [
                        'balance' => $balance,
                        'currency' => $currency,
                        'email' => $email,
                        'status' => $status,
                        'created_at' => $createdAt,
                        'id' => $id,
                    ];
            }

            // Encode data to JSON
            $jsonData = json_encode($data);

            // Write JSON data to file
            fwrite($file, $jsonData);

            // Add comma after each record except the last one
            if ($i < $numRecords - 1) {
                fwrite($file, ',');
            }
        }

        // Close JSON array enclosure
        fwrite($file, ']');

        // Close file
        fclose($file);
    }
}
