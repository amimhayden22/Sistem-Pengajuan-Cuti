<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AccountInformation;
use App\Models\{Employee, Position, User};
use Illuminate\Support\Facades\{DB, Hash, Mail};

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = Employee::all();

        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::orderBy('name', 'asc')->get();
        $employee = DB::table('employees')->select(DB::raw('MAX(RIGHT(code,3)) as code'));
        $generateNumber="";
        if ($employee->count()>0) {
            foreach ($employee->get() as $k) {
                $tmp = ((int)$k->code)+1;
                $generateNumber = sprintf("%03s", $tmp);
            }
        } else {
            $generateNumber = "001"; // kode awal default
        }

        return view('employees.create', compact('generateNumber', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'              => 'required|string|unique:employees,code',
            'name'              => 'required|string',
            'place_of_birth'    => 'required|string',
            'date_of_birth'     => 'required|date',
            'email'             => 'required|email',
            'address'           => 'required|string',
            'phone'             => 'required|numeric',
            'religion'          => 'required|not_in:0',
            'education'         => 'required|not_in:0',
            'bank'              => 'required|string',
            'account_number'    => 'required|numeric|digits_between:10,16',
            'position_id'       => 'required|integer',
        ],[
            'account_number.digits_between' => 'Account number must be 10-16 digits long!'
        ]);

        $createEmployee = Employee::create([
            'code'              => $request->code,
            'name'              => $request->name,
            'place_of_birth'    => $request->place_of_birth,
            'date_of_birth'     => $request->date_of_birth,
            'email'             => $request->email,
            'address'           => $request->address,
            'phone'             => $request->phone,
            'religion'          => $request->religion,
            'education'         => $request->education,
            'bank'              => $request->bank,
            'account_number'    => $request->account_number,
            'position_id'       => $request->position_id
        ]);

        return redirect('/dashboard/employees')->with('success', 'Tambah data berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $positions = Position::all();
        $employee = Employee::with(['position'])->find($id);
        if(is_null($employee)){
            return abort(404);
        }

        return view('employees.edit', compact('employee','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string',
            'place_of_birth'    => 'required|string',
            'date_of_birth'     => 'required|date',
            'email'             => 'required|email',
            'address'           => 'required|string',
            'phone'             => 'required|numeric',
            'religion'          => 'required|not_in:0',
            'education'         => 'required|not_in:0',
            'bank'              => 'required|string',
            'account_number'    => 'required|numeric|digits_between:10,16',
            'position_id'       => 'required|integer',
        ]);

            $updateEmployee = Employee::find($id);

            $updateEmployee->update([
                'code'              => $request->code,
                'name'              => $request->name,
                'place_of_birth'    => $request->place_of_birth,
                'date_of_birth'     => $request->date_of_birth,
                'email'             => $request->email,
                'address'           => $request->address,
                'phone'             => $request->phone,
                'religion'          => $request->religion,
                'education'         => $request->education,
                'bank'              => $request->bank,
                'account_number'    => $request->account_number,
                'position_id'       => $request->position_id
            ]);

        return redirect('/dashboard/employees')->with('success', 'Data berhasil diperbarui!');
    }

    /**
      * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteEmployee = Employee::find($id);
        $deleteEmployee->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function sendEmail($id)
    {
        $employee = Employee::find($id);
        if(is_null($employee)){
            return abort(404);
        }

        try {
            DB::beginTransaction();

            $generatePassword = 'Or1gin_'.date("Ymd", strtotime($employee->date_of_birth));

            $createUser = User::create([
                'name'              => $employee->name,
                'email'             => $employee->email,
                'email_verified_at' => now(),
                'password'          => Hash::make($generatePassword),
                'role'              => 'karyawan'
            ]);

            $employee->update([
                'user_id' => $createUser->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }

        Mail::to($employee->email)->send(new AccountInformation($employee));

        return redirect()->back()->with('email', 'Informasi akun untuk '.$employee->name.' telah dikirim!');

    }
}
