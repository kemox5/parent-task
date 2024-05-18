<?php

namespace Plugins\FilesReader\Dto;

use App\Dtos\Dto;

class TransactionDto extends Dto{
    public function __construct(
        public readonly float $amount,
        public readonly string $currency,
        public readonly string $email,
        public readonly int $status_code,
        public readonly string $registeration_date,
        public readonly string $id,
        public readonly string $source
    ) {
    }
}