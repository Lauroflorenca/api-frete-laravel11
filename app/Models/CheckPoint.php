<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckPoint extends Model
{
    protected $table = 'checkpoints';
    protected $fillable = [
        'local', 'ordem', 'chegada', 'observacao', 'viagem_id', 'ativo'
    ];

    public function viagem()
    {
        return $this->belongsTo(Viagem::class);
    }
}
