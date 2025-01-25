<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    protected $service;

    public function __construct(TransactionService $service){
        $this->service = $service;
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            $data = Transaction::with([
                'donatur:id,name,address,phone',
                'user:id,name,email'
            ]);
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        return view('backend.report.index');
    }
}
