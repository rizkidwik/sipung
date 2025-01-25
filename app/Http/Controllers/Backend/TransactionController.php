<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $service;

    public function __construct(TransactionService $service) {
        $this->service = $service;
    }
    public function index(){
        return view('backend.transaction.index');
    }

    public function getDonatur(){
        $search = request('q');
        $data = $this->service->getDonatur($search);

        return $this->success($data);
    }

    public function detailDonatur(){
        $id = request('id');

        $donatur = $this->service->detailDonatur($id);

        throw_if(!$donatur, new Exception('Donatur tidak ditemukan'));

        return $this->success($donatur);
    }

    public function getCategory(){
        $operation = $this->service->getCategory();
        
        return $this->success($operation);
    }

    public function store(){
        request()->validate([
            "donatur_id" => "required",
            "item" => "required|array",
            "item.*.id" => "required|ulid",
            "item.*.amount" => "required|numeric"
        ]);
        $operation = $this->service->saveTransaction(request()->all());

        return $this->success($operation);
    }

    public function print(string $id){
        
        $transaction = $this->service->detailTransaction($id);
        if(!$transaction){
            return redirect()->route('transaction.index');
        }

        return view('backend.transaction.form-print',compact('transaction'));
    }
}
