<?php

Route::group(['middleware' => ['preventbackbutton', 'auth']], function () {

    Route::group(['prefix' => 'department'], function () {
        Route::get('/', ['as' => 'department.index', 'uses' => 'Employee\DepartmentController@index']);
        Route::get('/create', ['as' => 'department.create', 'uses' => 'Employee\DepartmentController@create']);
        Route::post('/store', ['as' => 'department.store', 'uses' => 'Employee\DepartmentController@store']);
        Route::get('/{department}/edit', ['as' => 'department.edit', 'uses' => 'Employee\DepartmentController@edit']);
        Route::put('/{department}', ['as' => 'department.update', 'uses' => 'Employee\DepartmentController@update']);
        Route::delete('/{department}/delete', ['as' => 'department.delete', 'uses' => 'Employee\DepartmentController@destroy']);
    });

    Route::group(['prefix' => 'designation'], function () {
        Route::get('/', ['as' => 'designation.index', 'uses' => 'Employee\DesignationController@index']);
        Route::get('/create', ['as' => 'designation.create', 'uses' => 'Employee\DesignationController@create']);
        Route::post('/store', ['as' => 'designation.store', 'uses' => 'Employee\DesignationController@store']);
        Route::get('/{designation}/edit', ['as' => 'designation.edit', 'uses' => 'Employee\DesignationController@edit']);
        Route::put('/{designation}', ['as' => 'designation.update', 'uses' => 'Employee\DesignationController@update']);
        Route::delete('/{designation}/delete', ['as' => 'designation.delete', 'uses' => 'Employee\DesignationController@destroy']);
    });

    Route::group(['prefix' => 'branch'], function () {
        Route::get('/', ['as' => 'branch.index', 'uses' => 'Employee\BranchController@index']);
        Route::get('/create', ['as' => 'branch.create', 'uses' => 'Employee\BranchController@create']);
        Route::post('/store', ['as' => 'branch.store', 'uses' => 'Employee\BranchController@store']);
        Route::get('/{branch}/edit', ['as' => 'branch.edit', 'uses' => 'Employee\BranchController@edit']);
        Route::put('/{branch}', ['as' => 'branch.update', 'uses' => 'Employee\BranchController@update']);
        Route::delete('/{branch}/delete', ['as' => 'branch.delete', 'uses' => 'Employee\BranchController@destroy']);
        Route::get('/branch/restore/{id}', ['as' => 'branch.restore', 'uses' => 'Employee\BranchController@restore']);
    });

    Route::group(['prefix' => 'job'], function () {
        Route::get('/', ['as' => 'job.index', 'uses' => 'Employee\JobController@index']);
        Route::get('/create', ['as' => 'job.create', 'uses' => 'Employee\JobController@create']);
        Route::post('/store', ['as' => 'job.store', 'uses' => 'Employee\JobController@store']);
        Route::get('/{job}/edit', ['as' => 'job.edit', 'uses' => 'Employee\JobController@edit']);
        Route::put('/{job}', ['as' => 'job.update', 'uses' => 'Employee\JobController@update']);
        Route::delete('/{job}/delete', ['as' => 'job.delete', 'uses' => 'Employee\JobController@destroy']);
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', ['as' => 'employee.index', 'uses' => 'Employee\EmployeeController@index']);
        Route::get('/create', ['as' => 'employee.create', 'uses' => 'Employee\EmployeeController@create']);
        Route::post('/store', ['as' => 'employee.store', 'uses' => 'Employee\EmployeeController@store']);
        Route::get('/{employee}/edit', ['as' => 'employee.edit', 'uses' => 'Employee\EmployeeController@edit']);
        Route::get('/{employee}', ['as' => 'employee.show', 'uses' => 'Employee\EmployeeController@show']);
        Route::put('/{employee}', ['as' => 'employee.update', 'uses' => 'Employee\EmployeeController@update']);
        Route::delete('/{employee}/delete', ['as' => 'employee.delete', 'uses' => 'Employee\EmployeeController@destroy']);

        Route::get('/bulk-upload/csv', ['as' => 'employee.bulk', 'uses' => 'Employee\EmployeeController@getBulkUpload']);
        Route::post('/bulk-upload/csv', ['as' => 'store.bulk', 'uses' => 'Employee\EmployeeController@storeBulk']);
    });

    Route::get('/printEmployee', ['as' => 'employee.print', 'uses' => 'Employee\EmployeeController@printEmployee']);

    Route::group(['prefix' => 'warning'], function () {
        Route::get('/', ['as' => 'warning.index', 'uses' => 'Employee\WarningController@index']);
        Route::get('/create', ['as' => 'warning.create', 'uses' => 'Employee\WarningController@create']);
        Route::post('/store', ['as' => 'warning.store', 'uses' => 'Employee\WarningController@store']);
        Route::get('/{warning}/edit', ['as' => 'warning.edit', 'uses' => 'Employee\WarningController@edit']);
        Route::get('/{warning}', ['as' => 'warning.show', 'uses' => 'Employee\WarningController@show']);
        Route::get('/{warning}', ['as' => 'warning.show', 'uses' => 'Employee\WarningController@show']);
        Route::put('/{warning}', ['as' => 'warning.update', 'uses' => 'Employee\WarningController@update']);
        Route::delete('/{warning}/delete', ['as' => 'warning.delete', 'uses' => 'Employee\WarningController@destroy']);
    });

    Route::group(['prefix' => 'termination'], function () {
        Route::get('/', ['as' => 'termination.index', 'uses' => 'Employee\TerminationController@index']);
        Route::get('/create', ['as' => 'termination.create', 'uses' => 'Employee\TerminationController@create']);
        Route::post('/store', ['as' => 'termination.store', 'uses' => 'Employee\TerminationController@store']);
        Route::get('/{termination}/edit', ['as' => 'termination.edit', 'uses' => 'Employee\TerminationController@edit']);
        Route::get('/{termination}', ['as' => 'termination.show', 'uses' => 'Employee\TerminationController@show']);
        Route::get('/{termination}', ['as' => 'termination.show', 'uses' => 'Employee\TerminationController@show']);
        Route::put('/{termination}', ['as' => 'termination.update', 'uses' => 'Employee\TerminationController@update']);
        Route::delete('/{termination}/delete', ['as' => 'termination.delete', 'uses' => 'Employee\TerminationController@destroy']);
    });

    Route::group(['prefix' => 'permanent'], function () {
        Route::get('/', ['as' => 'permanent.index', 'uses' => 'Employee\EmployeePermanentController@index']);
        Route::get('/updatePermanent', 'Employee\EmployeePermanentController@updatePermanent');
    });


    Route::group(['prefix' => 'careerJob'], function () {
        Route::get('/', ['as' => 'careerJob.index', 'uses' => 'Employee\CareerController@index']);
        Route::delete('careerJob/{id}', ['as' => 'careerJob.destroy', 'uses' => 'Employee\CareerController@destroy'])->name('careerJob.destroy');
        Route::get('/{careerJobID}', ['as' => 'careerJob.show', 'uses' => 'Employee\CareerController@show']);
        Route::get('/{careerJobID}/edit', ['as' => 'careerJob.edit', 'uses' => 'Employee\CareerController@edit']);
        Route::put('/{careerJobID}', ['as' => 'careerJob.update', 'uses' => 'Employee\CareerController@update']);
        Route::delete('/{careerJobID}/delete', ['as' => 'careerJob.delete', 'uses' => 'Employee\CareerController@destroy']);
    });

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', ['as' => 'employees.index', 'uses' => 'Employee\EmployeesController@index']);
        Route::get('/{careerJobID}/makeemployee', ['as' => 'employees.makeemployee', 'uses' => 'Employee\EmployeesController@makeemployee']);
        Route::post('/store', ['as' => 'employees.store', 'uses' => 'Employee\EmployeesController@store']);
        Route::get('/{employee}/edit', ['as' => 'employees.edit', 'uses' => 'Employee\EmployeesController@edit']);
        Route::get('/{employee}', ['as' => 'employees.show', 'uses' => 'Employee\EmployeesController@show']);
        Route::put('/{employee}', ['as' => 'employees.update', 'uses' => 'Employee\EmployeesController@update']);
        Route::delete('/{employee}/delete', ['as' => 'employees.delete', 'uses' => 'Employee\EmployeesController@destroy']);
    });

    Route::group(['prefix' => 'assignJob'], function () {
        Route::get('/', ['as' => 'assignJob.index', 'uses' => 'Employee\AssignJobController@index']);
        Route::get('/inactive', ['as' => 'assignJob.inactive', 'uses' => 'Employee\AssignJobController@inactive']);
        Route::get('/create', ['as' => 'assignJob.create', 'uses' => 'Employee\AssignJobController@create']);
        Route::post('/store', ['as' => 'assignJob.store', 'uses' => 'Employee\AssignJobController@store']);
        Route::post('/changestatus', ['as' => 'assignJob.changestatus', 'uses' => 'Employee\AssignJobController@changestatus']);

        Route::get('/{jobID}', ['as' => 'assignJob.show', 'uses' => 'Employee\AssignJobController@show']);
        Route::get('/{jobID}/edit', ['as' => 'assignJob.edit', 'uses' => 'Employee\AssignJobController@edit']);
        Route::put('/{jobID}', ['as' => 'assignJob.update', 'uses' => 'Employee\AssignJobController@update']);
        Route::delete('/{jobID}/delete', ['as' => 'assignJob.delete', 'uses' => 'Employee\AssignJobController@destroy']);
        Route::get('/get-employee-details/{id}', ['as' => 'assignJob.getEmployeeDetails', 'uses' => 'Employee\AssignJobController@getEmployeeDetails']);
    });
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/', ['as' => 'attendance.index', 'uses' => 'Employee\AttendanceController@index']);
        Route::get('/create', ['as' => 'attendance.create', 'uses' => 'Employee\AttendanceController@create']);
        Route::post('/store', ['as' => 'attendance.store', 'uses' => 'Employee\AttendanceController@store']);
        Route::post('/employees', ['as' => 'attendance.getEmployees', 'uses' => 'Employee\AttendanceController@getCompanyEmployees']);
        Route::get('/export', ['as' => 'attendance.export', 'uses' => 'Employee\AttendanceController@exportCsv']);
        Route::post('/update-amounts', ['as' => 'attendance.updateAmounts', 'uses' => 'Employee\AttendanceController@updateAmounts']);
        Route::get('/export-pdf', ['as' => 'attendance.exportPdf', 'uses' => 'Employee\AttendanceController@exportPdf']);
    });

    Route::group(['prefix' => 'payroll'], function () {
        Route::get('/', ['as' => 'payroll.index', 'uses' => 'Employee\PayrollController@index']);
        Route::get('/calculateEmployeeSalary', ['as' => 'payroll.calculateEmployeeSalary', 'uses' => 'Employee\PayrollController@calculateEmployeeSalary']);
        Route::get('/salarys', ['as' => 'payroll.salarys', 'uses' => 'Employee\PayrollController@salary']);
        Route::post('/salarys', ['as' => 'payroll.salarys', 'uses' => 'Employee\PayrollController@salary']);
        Route::get('/export', ['as' => 'payroll.export', 'uses' => 'Employee\PayrollController@exportSalaryCsv']);
        Route::get('/pdf', ['as' => 'payroll.exportSalaryPdf', 'uses' => 'Employee\PayrollController@exportSalaryPdf']);
    });
});
