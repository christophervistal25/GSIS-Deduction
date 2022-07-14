<?php
namespace App\Controllers;

use App\Models\User;
use Twig\Environment;
use App\Models\Employee;
use App\Models\Deduction;
use App\Supports\Directory;
use Twig\Loader\FilesystemLoader;

class PostDeductionController
{
    public function index()
    {
        $loader = new FilesystemLoader(''. 'views');
        $twig = new Environment($loader);

        $employee = Employee::permanent()
                            ->active()
                            ->orderBy('LastName', 'ASC')
                            ->get(['FirstName', 'MiddleName', 'LastName', 'Suffix', 'Employee_id'])->take(100);

        $deductions = Deduction::with(['account'])->whereHas('account', function ($query) {
            $query->where('accountTitle', 'like', '%GSIS%');
        })->where('deductionType', 'P')
            ->orderBy('index', 'ASC')
            ->get()->each(function ($row) {
                $row->account->accountTitle = str_replace('GSIS - ', "", $row->account->accountTitle);
                $row->account->accountTitle = str_replace('GSIS - ', "", $row->account->accountTitle);
                $row->account->accountTitle = str_replace('LOAN', "", strtoupper($row->account->accountTitle));
        });

        echo $twig->render('post-deductions.twig', [
            'pageTitle' => 'Personal Deductions',
            'employees' => $employee,
            'deductions' => $deductions,
        ]);
    }

    public function remaining()
    {
        $employees = Employee::permanent()
                            ->active()
                            ->orderBy('LastName', 'ASC')
                            ->get(['FirstName', 'MiddleName', 'LastName', 'Suffix', 'Employee_id'])->skip(100);

        echo json_encode($employees);
    }
}