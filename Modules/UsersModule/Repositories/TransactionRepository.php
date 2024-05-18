<?php

namespace Modules\UsersModule\Repositories;

use Illuminate\Http\Request;
use Modules\UsersModule\Interfaces\Repositories\TransactionRepositoryInterface;
use Modules\UsersModule\Models\Order;
use Modules\UsersModule\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function list_users(Request $req)
    {
        $user = Order::query()
            ->groupBy('email');

        if ($req->provider) {
            $user->where('source', $req->provider);
        }

        if ($req->statusCode) {
            $status = [
                'authorised' => 100,
                'decline' => 200,
                'refunded' => 300,
            ];
            $user->where('status_code', $status[$req->statusCode]);
        }

        if ($req->currency) {
            $user->where('currency', $req->currency);
        }

        if ($req->balanceMin && $req->balanceMax) {
            $user
                ->where('amount', '>=', $req->balanceMin)
                ->where('amount', '<=', $req->balanceMax);
        }

        return $user->paginate($req->per_page ?? 20);
    }

    public function insert_many(array $transations)
    {
        Order::insert($transations);
    }
}
