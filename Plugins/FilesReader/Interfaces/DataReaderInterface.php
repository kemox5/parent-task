<?php

namespace Plugins\FilesReader\Interfaces;

use Plugins\FilesReader\Dto\TransactionDto;

interface DataReaderInterface
{
    public function read(string $filePath): bool;
    public function rules(): array;
    public function validate(object $data): bool;
    public function insertIntoDatabase(array $users): bool;
    public function convertToDto(object $json): TransactionDto;
}
