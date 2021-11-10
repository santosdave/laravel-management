<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_department' => Department::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_department',
            'title'    => 'Table Department'
        ];

        if ($request->ajax()) {
            $q_department = Department::select('*')->where('name','!=', '')->orderByDesc('created_at');
            return Datatables::of($q_department)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editDepartment"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteDepartment"><i class="fi-rr-trash"></i></div>';
 
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.v_template',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Department::updateOrCreate(['id' => $request->user_id],
                [
                 'name' => $request->name,
                 'details' => $request->email,
                ]);        

        return response()->json(['success'=>'Department saved successfully!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Department = Department::find($id);
        return response()->json($Department);

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Department::find($id)->delete();

        return response()->json(['success'=>'Department deleted!']);
    }
}
