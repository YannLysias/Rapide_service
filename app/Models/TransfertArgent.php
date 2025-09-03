<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransfertArgent extends Model
{
    protected $guarded = [];
    protected $table = 'transfert_argents';

    public function AgenceTransfert()
    {
        return $this->belongsTo(AgenceTransfert::class, 'agence_transfert_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
