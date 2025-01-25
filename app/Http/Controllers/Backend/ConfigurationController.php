<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigurationController extends Controller
{
    public function index()
    {
        return view('backend.configuration.index');
    }
    public function getConfig()
    {
        // $operation = Configuration::get();
        $operation['group'] = Configuration::select('config_group')->distinct()->get();
        $operation['config'] = Configuration::select('config_code', 'config_group', 'config_title', 'config_value')->get();

        return response()->json($operation);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            Configuration::where('config_code', str_replace('_', '.', $key))
                ->update(['config_value' => $value]);
        }
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => "Successfully saved data!",
        ]);
    }

    public function uploadLogo(Request $request)
    {
        try {
            $logo_file = $request->file('logo')->store('img', 'public');
            Configuration::where('config_code', 'app.logo')
                ->update(['config_value' => $logo_file]);
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => "Successfully saved data!",
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' =>
                [
                    "System Error!",
                    $e
                ]
            ]);
        }
    }

    public function logo()
    {
        $logo = Configuration::where('config_code', 'app.logo')->first();
        $storagePath = 'uploads/'. $logo->config_value;
        return response()->file($storagePath);
    }

}
