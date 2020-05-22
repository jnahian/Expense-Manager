<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
//    protected $dates   = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value);
    }

    public function setRemarksAttribute($value)
    {
        $this->attributes['remarks'] = base64_encode($value);
    }

    public function getRemarksAttribute($value)
    {
        return base64_decode($value, true);
    }
}
