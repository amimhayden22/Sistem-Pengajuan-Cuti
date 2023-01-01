<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{Employee, Transaction, User};
use Illuminate\Support\Facades\{Auth, Hash, Mail, Http};
use App\Mail\{LeaveApplicationInformation, ApprovedLeaveApplication, LeaveApplicationRejected};

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkRole = Auth::user()->role;

        if($checkRole === 'Karyawan'){
            $transactions = Transaction::where('employee_id', Auth::user()->employee->id)->get();
        }elseif($checkRole === 'User'){
            return abort(404);
        }else{
            $transactions = Transaction::all();
        }

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('transactions.create', compact('employees'));
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
            'leave_date'          => 'required|date',
            'return_date'         => 'required|date',
            'description'         => 'required|string',
            'applicant_signature' => 'required',
        ]);

        $uuid = Str::uuid()->toString();

        $folderPath = public_path('backend/assets/img/signature/');
        $imageParts = explode(";base64,", $request->applicant_signature);
        $imageTypeAux = explode("image/", $imageParts[0]);
        $imageType = $imageTypeAux[1];
        $imageBase64 = base64_decode($imageParts[1]);
        $signature = 'a4f212c8-'.$uuid.'.'. $imageType;
        $file = $folderPath . $signature;
        file_put_contents($file, $imageBase64);

        $createTransaction = Transaction::create([
            'employee_id'         => Auth::user()->employee->id,
            'leave_date'          => $request->leave_date,
            'return_date'         => $request->return_date,
            'description'         => $request->description,
            'status'              => $request->status,
            'applicant_signature' => $signature,
        ]);

        $checkHrd = User::whereRole('HRD')->first();
        if (is_null($checkHrd)) {
            return redirect()->back()->with('failed', 'Sistem mengalami error, silakan menghubungi Tim Dev. Terima kasih!')->withInput($request->all());
        }

        Mail::to($checkHrd->email, $checkHrd->name)->send(new LeaveApplicationInformation($createTransaction));

        return redirect('/dashboard/leave-application')->with('success', 'Pengajuan Cuti Berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with('employee')->find($id);
        // return($transaction);
        return view('transactions.preview', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::all();
        $transaction = Transaction::with('employee')->find($id);
        if (is_null($transaction)) {
            return abort(404);
        }
        if ($transaction->status != 'Mengajukan') {
            return abort(403, 'Data sudah tidak bisa di edit!');
        }

        return view('transactions.edit', compact('transaction','employee'));
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
            'leave_date'          => 'required|date',
            'return_date'         => 'required|date',
            'description'         => 'required|string',
        ]);

        $updateTransaction = Transaction::find($id);

        $updateTransaction->update([
            'leave_date'          => $request->leave_date,
            'return_date'         => $request->return_date,
            'description'         => $request->description,
            'reason'              => $request->reason,
            'status'              => $request->status,
        ]);

        $checkEmployee = Employee::where('id', $updateTransaction->employee_id)->first();

        if(is_null($checkEmployee->email)){
            return redirect()->back()->with('failed', 'Data karyawan tidak ditemukan, silakan menghubungi Tim Dev. Terima kasih!');
        }

        if ($updateTransaction->status === 'Disetujui'){
            Mail::to($checkEmployee->email, $checkEmployee->name)->send(new ApprovedLeaveApplication($updateTransaction));
        }else{
            Mail::to($checkEmployee->email, $checkEmployee->name)->send(new LeaveApplicationRejected($updateTransaction));
        }

        return redirect('/dashboard/leave-application')->with('success', 'Pengajuan Cuti Karyawan Diproses!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteTransactions = Transaction::find($id);
        $deleteTransactions->delete();

        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);

    }
}
