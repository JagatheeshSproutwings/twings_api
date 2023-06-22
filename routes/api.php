<?php

use App\Http\Controllers\Api\{
    LoginController,
    RegisterController,
    AdminDashboardController,
    UserDashboardController,
    CountryController,
    RoleController,
    PermissionController,
    RolePermissionController
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('user', [RegisterController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('user/dashboard', [UserDashboardController::class, 'index']);
    });
});


//Country
Route::get('countries', [CountryController::class, 'index']);
Route::post('countries', [CountryController::class, 'store']);
Route::get('countries/{id}', [CountryController::class, 'show']);
Route::put('countries/{id}', [CountryController::class, 'update'])->name('countries.update');
Route::delete('countries/{id}', [CountryController::class, 'destroy']);

//Roles
Route::get('roles', [RoleController::class, 'index']);
Route::post('roles', [RoleController::class, 'store']);
Route::get('roles/{id}', [RoleController::class, 'show']);
Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('roles/{id}', [RoleController::class, 'destroy']);

//Permissions
Route::get('permissions', [PermissionController::class, 'index']);
Route::post('permissions', [PermissionController::class, 'store']);
Route::get('permissions/{id}', [PermissionController::class, 'show']);
Route::put('permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('permissions/{id}', [PermissionController::class, 'destroy']);


//RolePermission
Route::get('roleandpermissions', [RolePermissionController::class, 'index']);
Route::post('roleandpermissions', [RolePermissionController::class, 'store']);
Route::get('roleandpermissions/{roleid}&{permissionId}', [RolePermissionController::class, 'show']);
Route::put('roleandpermissions/{roleid}&{permissionId}', [RolePermissionController::class, 'update'])->name('roleandpermissions.update');
Route::delete('roleandpermissions/{roleid}&{permissionId}', [RolePermissionController::class, 'destroy']);
