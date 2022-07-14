<?php

namespace App\Models;

use App\Models\Deduction;
use App\Maintenance\GovernmentShare;
use App\Maintenance\Compensation;
use Illuminate\Database\Eloquent\Model;



class AccountsChart extends Model
{
    protected $table = 'AccountsChart';
    public $primaryKey = 'accountCode';
    public $incrementing = false;
    protected $keyType = 'string';
    

    protected $fillable = ['accountCode', 'accountTitle', 'aType', 'hasSubAccounts', 'pCode', 'accountDesc', 'accountEntryType', 'payrollTransType'];

    public function deduction()
    {
        return $this->hasOne(Deduction::class, 'accountCode', 'accountCode');
    }
    public function governmentShare()
    {
        return $this->hasOne(GovernmentShare::class, 'accountCode', 'accountCode');
    }
    public function compensation()
    {
        return $this->hasOne(Compensation::class, 'accountCode', 'accountCode');
    }

}
