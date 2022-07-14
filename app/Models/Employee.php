<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = 'Employees';
    public $primaryKey = 'Employee_id';
    public $timestamps = false;

    public function deduct()
    {
        return $this->hasMany(Deduct::class, 'employee_id', 'Employee_id');
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