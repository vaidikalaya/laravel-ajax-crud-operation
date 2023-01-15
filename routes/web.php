<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EmployeeController};

Route::get('/', [EmployeeController::class,'index']);
Route::post('add-update-employee',[EmployeeController::class,'addUpdateEmployee']);
Route::get('edit-employee/{employeeId}',[EmployeeController::class,'editEmployee']);
Route::delete('delete-employee/{employeeId}',[EmployeeController::class,'deleteEmployee']);