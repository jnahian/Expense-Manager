<?php

namespace App;

use App\Enums\Status;
use App\Enums\TransactionType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'account_id',
        'type',
        'amount',
        'desc',
        'status',
    ];

    const TYPES = [
        ['id' => TransactionType::INCOME, 'name' => 'Income'],
        ['id' => TransactionType::EXPENSE, 'name' => 'Expense']
    ];

    const STATUS = [
        ['id' => Status::ACTIVE, 'name' => "Active"],
        ['id' => Status::DISABLED, 'name' => "Disabled"],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getStatusAttribute($value)
    {
        return collect(self::STATUS)->firstWhere('id', $value);
    }

    public function transactionTypes()
    {
        return self::TYPES;
    }

    public function getTypeAttribute($value)
    {
        return collect(self::TYPES)->firstWhere('id', $value);
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value);
    }
}
