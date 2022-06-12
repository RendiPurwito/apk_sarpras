<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function operatoruser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function keluaroperator(){
        return $this->hasone(Operator::class);
    }
}
