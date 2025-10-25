<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'master_states';
    protected $primaryKey = 'state_id';

    protected $fillable = ['state_name'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
