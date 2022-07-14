<?php

namespace App\Models;

use App\Maintenance\Employee;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Deduct extends Model
{
    public $timestamps = false;
    protected $fillable = ['employee_id', 'amount', 'deductable_id', 'deductable_type'];
    
    public function deductable()
    {
        return $this->morphTo();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'Employee_id')
                                    ->select('Employee_id', 'FirstName', 'MiddleName', 'LastName', 'Suffix', 'sg_no', 'step', 'salary_rate');
    }

}
