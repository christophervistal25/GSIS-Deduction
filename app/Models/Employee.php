<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = 'Employees';
    public $primaryKey = 'Employee_id';
    public $timestamps = false;
    public $keyType = 'string';

    public function deduct_record()
    {
        return $this->hasMany(Deduct::class, 'employee_id', 'Employee_id')->where('deductable_type', 'App\Maintenance\Deduction');
    }

    public function scopePermanent($query)
    {
        return $query->where('Work_Status', 'not like', '%' . 'JOB ORDER' . '%')
                    ->where('Work_Status', 'not like', '%' . 'CONTRACT OF SERVICE' . '%')
                    ->where('Work_Status', '!=', '');
    }

    public function scopeActive($query)
    {
        return $query->where('isActive', 1);
    }
}