<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = "contacts";
    protected $primaryKey = "uuid";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['first_name','last_name','phone','email'];
}
