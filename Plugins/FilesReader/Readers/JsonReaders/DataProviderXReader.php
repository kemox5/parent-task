<?php

namespace Plugins\FilesReader\Readers\JsonReaders;

use Plugins\FilesReader\Dto\TransactionDto;
use Plugins\FilesReader\Readers\JsonReader;

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

class DataProviderXReader extends JsonReader
{
    private $status = [
        '1' => 100,
        '2' => 200,
        '3' => 300,
    ];

    public function rules(): array
    {
        return [
            'parentAmount' => ['numeric', 'required'],
            'Currency' => ['string', 'required', 'size:3'],
            'parentEmail' => ['email', 'required'],
            'statusCode' => ['numeric', 'in:1,2,3'],
            'registerationDate' => ['date_format:Y-m-d', 'required'],
            'parentIdentification' => ['string', 'required'],
        ];
    }


    public function convertToDto(object $json): TransactionDto
    {
        return new TransactionDto(
            $json->parentAmount,
            $json->Currency,
            $json->parentEmail,
            $this->status[$json->statusCode],
            $json->registerationDate,
            $json->parentIdentification,
            'DataProviderX'
        );
    }
}
