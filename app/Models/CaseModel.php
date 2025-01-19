<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseModel extends Model
{
    protected $table = 'cases';
    protected $fillable = ['title', 'client_id', 'status', 'national_id', 'description'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
