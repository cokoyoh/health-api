<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'token', 'expire_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * Relation with User class
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
