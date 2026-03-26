<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs_d';
    protected $fillable = ['user_id', 'acao', 'descricao'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function despesa()
    {
        return $this->belongsTo(Despesa::class);
    }
}
