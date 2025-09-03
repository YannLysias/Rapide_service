<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgenceTransfert extends Model
{
    protected $guarded = [];
    protected $table = 'agences_transfert';

    public function users()
    {
        return $this->belongsToMany(User::class, 'agence_user', 'agence_transfert_id', 'user_id');
    }
}
