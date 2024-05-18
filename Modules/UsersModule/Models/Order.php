<?php

namespace Modules\UsersModule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\UsersModule\Database\Factories\OrderFactory;

class Order extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public $table = 'orders';

    protected $guarded = [];

     /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return OrderFactory::new();
    }
}
