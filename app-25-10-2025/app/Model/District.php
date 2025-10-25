<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'master_districts';
    protected $primaryKey = 'dist_id';
    protected $fillable = ['dist_id', 'state_id', 'dist_name'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
