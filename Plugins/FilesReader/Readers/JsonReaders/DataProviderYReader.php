<?php

namespace Plugins\FilesReader\Readers\JsonReaders;

use DateTime;
use Plugins\FilesReader\Dto\TransactionDto;
use Plugins\FilesReader\Readers\JsonReader;

/* 
{
    balance:300,
    currency:'AED',
    email:'parent2@parent.eu',
    status:100,
    created_at: '22/12/2018',
    id: '4fc2-a8d1'
}
*/


class DataProviderYReader extends JsonReader
{


    public function rules(): array
    {
        return [
            'balance' => ['numeric', 'required'],
            'currency' => ['string', 'required', 'size:3'],
            'email' => ['email', 'required'],
            'status' => ['numeric', 'in:100,200,300'],
            'created_at' => ['required', 'date_format:d/m/Y'],
            'id' => ['string', 'required'],
        ];
    }


    private function fixDate(string $date): string
    {
        $date = DateTime::createFromFormat('d/m/Y', $date);
        return $date->format('Y-m-d');
    }

    public function convertToDto(object $json): TransactionDto
    {
        return new TransactionDto(
            $json->balance,
            $json->currency,
            $json->email,
            $json->status,
            $this->fixDate($json->created_at),
            $json->id,
            'DataProviderY'
        );
    }
}
