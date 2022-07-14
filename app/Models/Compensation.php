<?php

namespace App\Models;

use App\Deduct;
use App\Maintenance\AccountsChart;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Compensation extends Model
{
    use LogsActivity;
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected $table = 'Compensation';
    public $primaryKey = 'comCode';
    public $incrementing = true;

    protected $fillable = ['accountCode', 'computation', 'percentage', 'amount', 'addToSalary', 'comCat'];

    public function account()
    {
        return $this->hasOne(AccountsChart::class, 'accountCode', 'accountCode');
    }

    public function deduct()
    {
        return $this->morphMany(Deduct::class, 'deductable');
    }

}
