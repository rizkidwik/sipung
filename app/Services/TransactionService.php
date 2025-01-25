<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Donatur;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionService extends Controller {
    public function getDonatur(string | null $search){
        $donatur = Donatur::select('id', 'name as text');
        
        if($search){
            $donatur = $donatur->where('name', 'like', '%' . $search . '%');
        }

        return $donatur->get();
    }

    public function detailDonatur(string $id){
        $donatur = Donatur::find($id);

        throw_if(!$donatur, new Exception('Donatur tidak ditemukan'));

        return $donatur;
    }

    public function getCategory(){
        $category = Category::get();

        $data['tetap'] = $category->where('type',Category::TYPE['FIX'])->values();
        $data['bebas'] = $category->where('type', Category::TYPE['FREE'])->values();
        
        return $data;
    }

    public function saveTransaction(array $params){
        try{
            DB::beginTransaction();
            $totalAmount = collect($params['item'])->sum('amount');

            $transaction = Transaction::create([
                'donatur_id' => $params['donatur_id'],
                'user_id' => auth()->user()->id,
                'total' => $totalAmount
            ]);
            
            $dataItem = [];
            foreach($params['item'] as $value){
                $dataItem[] = [
                    'id' => (string) Str::ulid(),
                    'transaction_id' => $transaction->id,
                    'item_id' => $value['id'],
                    'amount' => $value['amount']
                ];
            }

            TransactionDetail::insert($dataItem);
            DB::commit();

            return $transaction;
        } catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function detailTransaction(string $id){
        $data = Transaction::with([
                'details',
                'details.item:id,name',
                'donatur:id,name,address,phone',
                'user:id,name,email'
            ])->find($id);

        return $data;
    }
}
