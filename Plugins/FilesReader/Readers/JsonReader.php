<?php

namespace Plugins\FilesReader\Readers;

use Illuminate\Support\Facades\Validator;
use JsonMachine\Items;
use Modules\UsersModule\Interfaces\Repositories\TransactionRepositoryInterface;
use Modules\UsersModule\Models\Transaction;
use Modules\UsersModule\Repositories\TransactionRepository;
use Plugins\FilesReader\Dto\TransactionDto;
use Plugins\FilesReader\Interfaces\DataReaderInterface;

abstract class JsonReader implements DataReaderInterface
{

    private TransactionRepository $transactionRepo;

    public function __construct()
    {
        $this->transactionRepo = new TransactionRepository();
    }

    abstract public function rules(): array;

    abstract public function convertToDto(object $json): TransactionDto;

    public function validate(object $data): bool
    {
        $validator = Validator::make((array) $data, $this->rules());
        return !$validator->fails();
    }

    public function read($path): bool
    {
        $items = Items::fromFile($path);

        foreach ($items as $item) {

            if ($this->validate($item)) {
                $transaction = $this->convertToDto($item);
                $transactions[] = $transaction->toArray();
            }

            if (count($transactions) >= 50) {
                $this->insertIntoDatabase($transactions);
                $transactions = [];
            }
        }

        if (count($transactions) > 0) {
            $this->insertIntoDatabase($transactions);
        }

        return true;
    }

    public function insertIntoDatabase(array $transactions): bool
    {
        $this->transactionRepo->insert_many($transactions);
        return true;
    }
}
