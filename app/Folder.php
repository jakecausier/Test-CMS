<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasContentTrait;

class Folder extends Model
{

    use HasContentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

}
