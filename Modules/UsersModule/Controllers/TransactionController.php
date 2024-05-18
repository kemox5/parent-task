<?php

namespace Modules\UsersModule\Controllers;

use App\Http\Controllers\ApiBaseController;
use Modules\UsersModule\Resources\UserResource;
use Modules\UsersModule\Interfaces\Repositories\TransactionRepositoryInterface;
use Modules\UsersModule\Requests\ListUsersRequest;

class TransactionController extends ApiBaseController
{
    /**
     * List users
     * 
     *  list all users which combine transactaions from all the available providerDataProviderX and DataProviderY
     * 
     * 
     *  @response array{success: boolean, users: UserResource[], meta:array{total: int, currentPage: int, perPage: int} }
     */
    public function list_users(ListUsersRequest $req, TransactionRepositoryInterface $transaction)
    {
        $users = $transaction->list_users($req);

        // return $users;
        return $this->success(
            [
                'meta' => [
                    'total' => $users->total(),
                    'currentPage' => $users->currentPage(),
                    'perPage' => $users->perPage(),
                ],
                'users' => UserResource::collection($users)
            ]
        );
    }
}
