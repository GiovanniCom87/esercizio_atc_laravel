<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index(){
        $resourcesDB = Resource::select('resources.*', 'departments.department', 'tasks.task', DB::raw('SUM(tasks.price) AS tprice'), 'tasks.date')
        ->groupBy('resources.id', 'departments.id', 'tasks.id')
        ->leftjoin('departments', 'resources.department_id', '=', 'departments.id')
        ->orderBy('department')
        ->leftjoin('tasks', 'resources.id', '=', 'tasks.resource_id')
        ->orderBy('price', 'desc')
        ->get();

        $resources = $resourcesDB->groupBy('id');

        return view('welcome', compact('resources'));
    }

    public function filter(Request $request){

        $from=$request->from;
        $to=$request->to;
        
        $resourcesDB = Resource::select('resources.*', 'departments.department', 'tasks.task', DB::raw('SUM(tasks.price) AS tprice'), 'tasks.date')
        ->groupBy('resources.id', 'departments.id', 'tasks.id')
        ->leftjoin('departments', 'resources.department_id', '=', 'departments.id')
        ->orderBy('department')
        ->leftjoin('tasks', 'resources.id', '=', 'tasks.resource_id')
        ->orderBy('price', 'desc')
        ->whereBetween('tasks.date', [$from, $to ])
        ->get();

        $resources = $resourcesDB->groupBy('id');
      

        return view('filter', compact('resources', 'from', 'to'));
    }
}
