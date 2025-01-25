<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DonaturController extends Controller
{
    public function table(Request $request) {
        if ($request->ajax()) {
            $data = Donatur::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a onclick="onEdit(`' . $row->id . '`)" class="edit-button edit btn btn-primary btn-sm me-2">Edit </a>
                    <a onclick="onDelete(`' . $row->id . '`)" class="edit-button edit btn btn-danger btn-sm">Delete </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        return view('backend.donatur.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        Donatur::updateOrCreate(
            [
                'id' => $request->id
            ],
            $request->all()
        );

        return response()->json(['success' => 'Donatur saved successfully.']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {
        try {
            $data = Donatur::findOrFail($request->id);
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => "Successfully get data!",
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => $th
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request) {
        $data = Donatur::findOrFail($request->id);
        $data->delete();
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => "Deleted data successfully"
        ]);
    }
}
