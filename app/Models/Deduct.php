<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;


class Deduct extends Model
{
    public $table = 'deducts';
    public $timestamps = false;
    protected $fillable = ['employee_id', 'amount', 'deductable_id', 'deductable_type'];
    
    public function personal_deduction()
    {
        return $this->hasOne('App\Models\Deduction', 'dCode', 'deductable_id')->where('deductionType', 'P');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'Employee_id')
                                    ->select('Employee_id', 'FirstName', 'MiddleName', 'LastName', 'Suffix', 'sg_no', 'step', 'salary_rate');
    }

}
