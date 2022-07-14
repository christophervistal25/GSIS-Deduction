<?php

namespace App\Models;

use App\Models\AccountsChart;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $table = 'Deduction';
    public $primaryKey = 'dCode';
    public $incrementing = true;

    protected $fillable = ['accountCode', 'computation', 'percentage', 'amount', 'isDeducted', 'deductionType'];

    public function account()
    {
        return $this->hasOne(AccountsChart::class, 'accountCode', 'accountCode')->withDefault();
    }

}
