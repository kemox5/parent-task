<?php

namespace Modules\UsersModule\Interfaces\Repositories;

use Illuminate\Http\Request;

interface TransactionRepositoryInterface{
    public function list_users(Request $req);
    public function insert_many(array $transations);
}
