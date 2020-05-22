<?php

namespace App;

use App\Enums\AccountType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'balance',
        'status',
    ];

    const TYPES = [
        ['id' => AccountType::DEBIT, 'name' => 'Debit'],
        ['id' => AccountType::CREDIT, 'name' => 'Credit']
    ];

    const STATUS = [
        ['id' => Status::ACTIVE, 'name' => "Active"],
        ['id' => Status::DISABLED, 'name' => "Disabled"],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accountTypes()
    {
        return self::TYPES;
    }

    public function getTypeAttribute($value)
    {
        return collect(self::TYPES)->firstWhere('id', $value);
    }

    public function getStatusAttribute($value)
    {
        return collect(self::STATUS)->firstWhere('id', $value);
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }
}
