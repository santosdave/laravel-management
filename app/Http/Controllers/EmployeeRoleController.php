<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Employee_role;
use Illuminate\Support\Facades\DB;

class EmployeeRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_e_role' => Employee_role::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_employee_role',
            'title'    => 'Table Employee Roles'
        ];

        if ($request->ajax()) {
            $q_employee_role = Employee_role::select('*')->where('role_id','!=', 0)->orderByDesc('created_at');
            return Datatables::of($q_employee_role)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->role_id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editRole"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->role_id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteRole"><i class="fi-rr-trash"></i></div>';
 
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
        Employee_role::updateOrCreate(['role_id' => $request->role_id],
                [
                 'role_name' => $request->role_name,
                 'role_details' => $request->role_details,
                ]);        

        return response()->json(['success'=>'Employee Role saved successfully!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Employee_role = Employee_role::find($id);
        return response()->json($Employee_role);

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Employee_role::find($id)->delete();

        return response()->json(['success'=>'Employee Role deleted!']);
    }
}
