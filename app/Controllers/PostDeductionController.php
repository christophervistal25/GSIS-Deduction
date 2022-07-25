<?php
namespace App\Controllers;

use Twig\Environment;
use App\Models\Deduct;
use App\Models\Employee;
use App\Models\Deduction;
use App\Supports\Redirect;
use Twig\Loader\FilesystemLoader;
use Illuminate\Database\Capsule\Manager as Capsule;

class PostDeductionController
{
    public function index()
    {
        // Check if there's a user logged in
        if (!isset($_SESSION['user'])) {
            return Redirect::to('login');
        }
        
        $loader = new FilesystemLoader(''. 'views');
        $twig = new Environment($loader);
        

        $deductions = Deduction::with('account')
                                ->has('account')
                                ->where('deductionType', 'P')
                                ->orderBy('index', 'ASC')
                                ->get();

        $offices = Capsule::table('Office')->get(['OfficeCode', 'Description']);

        echo $twig->render('post-deductions.html', [
            'pageTitle'  => 'GSIS Deductions',
            'deductions' => $deductions,
            'offices'    => $offices,
            'user' => $_SESSION['user'],
        ]);
    }

    public function fetched()
    {
         // Check if there's a user logged in
         if (!isset($_SESSION['user'])) {
            return Redirect::to('login');
        }

        $deductions = Deduction::with('account')
                                ->has('account')
                                ->where('deductionType', 'P')
                                ->orderBy('index', 'ASC')
                                ->get()->pluck('dCode')->toArray();

        $employees = Employee::permanent()
                            ->active()
                            ->orderBy('LastName', 'ASC')
                            ->with(['deduct_record' => function ($query) use($deductions) {
                                $query->whereIn('deductable_id', $deductions);
                            }])
                            ->get(['FirstName', 'MiddleName', 'LastName', 'Suffix', 'Employee_id']);
        
        $data = [];
        $total = 0;
        foreach($employees as $employee) {
            $temp = [];

           /* Checking if the employee has a deduction record. If it does not have a deduction record,
           it will fill the array with 0 values. If it has a deduction record, it will get the amount of
           the deduction. */
            if($employee->deduct_record->isEmpty()) {
                $temp = array_fill(0, count($deductions), "0");
                $temp[count($temp)] = "<span class='text-truncate' data-id=" . $employee->Employee_id . ">$employee->LastName, $employee->FirstName $employee->MiddleName $employee->Suffix</span>";
            } else {
                foreach($deductions as $d) {
                    $temp[] = number_format($employee->deduct_record->where('deductable_id', $d)->first()->amount ?? 0, 2, ".", "");
                }
                $temp[count($temp)] = "<span class='text-truncate' data-id=" . $employee->Employee_id . ">$employee->LastName, $employee->FirstName $employee->MiddleName $employee->Suffix</span>";
            }
            // $temp = array_reverse($temp);

            // Total Column
            $total += array_sum(array_column($employee['deduct_record']->toArray(), 'amount'));
            $temp[count($temp)] = number_format(array_sum(array_column($employee['deduct_record']->toArray(), 'amount')), 2, ".", "");


            /* Just a way to move the last element of the array to the first element of the array. */
            $i = 0;
            $newArray[] = null;
            while($i < count($temp)) {
                $newArray[$i + 1] = $temp[$i];
                $i++;
            }

            $newArray[0] = $newArray[$i - 1];
            unset($newArray[$i - 1]);
            $newArray = array_values($newArray);

            $data[] = $newArray;
        }

        echo json_encode([
            'aaData' => $data,
            'total' => number_format($total, 2, ".", ","),
        ]);
    }

    public function store(array $data = [])
    {
        // Check if there's a user logged in
        if (!isset($_SESSION['user'])) {
            return Redirect::to('login');
        }
        
        extract($data);
        $deductions = Deduction::with('account')
                                ->has('account')
                                ->where('deductionType', 'P')
                                ->orderBy('index', 'ASC')->get()->pluck('dCode')->toArray();
        // database transaction
        Capsule::transaction(function () use ($deductions, $data) {
            foreach($data as $records) {
                Deduct::where('employee_id', $records['Employee_ID'])
                        ->whereIn('deductable_id', $deductions)
                        ->where('deductable_type', 'App\Maintenance\Deduction')
                        ->get()
                        ->each
                        ->delete();

                foreach($records['Deductions'] as $deduction) {
                        Deduct::updateOrCreate([
                            'employee_id' => $records['Employee_ID'],
                            'deductable_id' => $deduction['Deduction_ID'],
                        ], [
                            'employee_id' => $records['Employee_ID'],
                            'deductable_id' => $deduction['Deduction_ID'],
                            'amount' => $deduction['Amount'],
                            'deductable_type' => 'App\Maintenance\Deduction',
                        ]);
                }

            }
        });
            

       header('Content-Type: application/json; charset=utf-8');
        
        echo json_encode([
            'success' => true,
        ]);
    }
}