<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Yajra\DataTables\Datatables;

class UserController extends Controller
{

    protected $service;

    public function __construct(UserService $service){
        $this->service = $service;
    }

    public function table(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->select('*');
            return Datatables::of($data)
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
    public function index()
    {
        return view('backend.user.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Check Duplicate Email & Username
        $email = $this->service->checkDuplicateEmail($request->all());
        $username = $this->service->checkDuplicateUsername($request->all());

        throw_if($email, new Exception('Email sudah digunakan'));

        throw_if($username, new Exception('Username sudah digunakan'));

        if($data['password'] == $data['password2']){
            $data['password'] = bcrypt($data['password']);
            User::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                $data
            );

            return response()->json(['status' => 'success', 'message' => 'Data Save Successfully.']);
        } else {
            return response()->json(['status' => 'info', 'message' => 'Password tidak sama'],422);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {
        try {
            $data = User::findOrFail($request->id);
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
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->delete();
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => "Deleted data successfully"
        ]);
    }

    public function getRoles(Request $request)
    {
        $where = [];
        if ($request->q) {
            $where = ['role_name' => $request->q];
        }
        $role = Role::select('id', 'role_code AS text')->where($where)->get();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => "Get data successfully",
            'data' => $role
        ]);
    }
}
