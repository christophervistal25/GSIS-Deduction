<?php

namespace App\Models;

use App\Models\Models;
use App\Models\AccountsChart;
use Illuminate\Database\Eloquent\Model;


class GovernmentShare extends Model
{
    protected $table = 'GovernmentShares';
    public $primaryKey = 'gsCode';
    public $incrementing = true;

    protected $fillable = ['accountCode', 'computation', 'percentage', 'amount'];



    public function account()
    {
        return $this->hasOne(AccountsChart::class, 'accountCode', 'accountCode');
    }

    public function deduct()
    {
        return $this->morphMany(Deduct::class, 'deductable');
    }

}
