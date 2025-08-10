<?php

namespace App\Bank\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;

class AccountEloquent extends Model
{
    protected $table = 'accounts';
    protected $fillable = ['id', 'balance'];

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
