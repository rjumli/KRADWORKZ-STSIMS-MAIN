<?php

namespace App\Http\Controllers\Utility;

use App\Services\Utility\BackupService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function __construct(BackupService $backup){
        $this->backup = $backup;
    }

    public function index(Request $request){
        $options = $request->option;
        switch($options){
            case 'lists':
               return $this->backup->lists();
            break;
            default : 
            return inertia('Modules/Utility/Backups/Index');
        }
    }

    public function show($name){
        return $this->backup->download($name);
    }

    public function create()
    {
        $data = $this->backup->generate();
   
        return back()->with([
            'data' => $data,
            'message' => 'Backup was successfully. Thanks',
            'info' => '-',
            'status' => 1,
            'color' => 'success'
        ]);
    }
}
