<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Viagem extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'viagens';

    protected $fillable = [
        'titulo', 'descricao', 'motorista', 'placa', 'dt_origem', 'dt_destino',
        'origem', 'destino', 'conteudo', 'ativo'
    ];

    public function checkpoints()
    {
        return $this->hasMany(CheckPoint::class);
    }
}
