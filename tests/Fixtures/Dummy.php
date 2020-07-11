<?php

namespace Radiocubito\Orderable\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Radiocubito\Orderable\HasOrder;

class Dummy extends Model
{
    use HasOrder;

    protected $table = 'dummies';

    protected $guarded = [];

    protected $casts = [
        'order_column' => 'float',
    ];

    public $timestamps = false;
}
