<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{
    /**
     * Display the login form
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('employee.login');
    }

    /**
     * Authenticate employee
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'loginError' => 'Username or Password incorrect'
        ])->onlyInput('username');
    }

    /**
     * Logout employee
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        $newEmployee = new Employee();
        $newEmployee->name = $validated['name'];
        $newEmployee->username = $validated['username'];
        $newEmployee->password = $validated['password'];
        $newEmployee->role = $validated['role'];

        if ($newEmployee->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data karyawan',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data karyawan',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        $employee->name = $validated['name'];
        $employee->username = $validated['username'];
        $employee->role = $validated['role'];

        if (isset($validated['password'])) {
            $employee->password = $validated['password'];
        }

        if ($employee->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menyimpan data karyawan',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data karyawan',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Gate::authorize('admin-page');

        if ($employee->delete()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Berhasil menghapus data karyawan.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data karyawan.',
            ], 500);
        }
    }
}