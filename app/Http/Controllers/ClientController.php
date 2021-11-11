<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Therapist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function success(Request $request)
    {
        Toastr::success($request->status.' Successfully', '', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['therapist'] = Therapist::all();
        $data['room_categorys'] = RoomCategory::all();
        $data['rooms'] = Room::all();
        $data['client'] = Client::all();
        $data['content']='content.view_clients';
        $data['menu']='menu.v_menu_admin';
        return view('layouts.v_template',$data);
    }

    public function store(Request $request)
    {
        $client = new Client;
        $validation = Validator::make($request->all(), $client->validation());
        if($validation->fails()) {
            $status = 400;
            $response = [
                "status" => $status,
                "errors"   => $validation->errors(),
            ];
        } else {
            $client->fill($request->all())->save();
            $status = 201;
            $response = [
                "status" => $status,
                "data"   => $client,
            ];
            $room_status=['room_status'=>'booked'];
            Room::where('room_id',$request->c_room_id)->update($room_status);
        }
        return response()->json($response, $status);
    }

    public function show(Request $request)
    {
        $id=$request->id;
        $data['client']=$client=Client::find($id);
        $data['therapist']=Therapist::find($client->c_ther_id);
        $data['room_cat']=RoomCategory::find($client->c_room_category_id);
        $data['room']=Room::find($client->c_room_id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Client::where('c_id', $id)->delete();
        $status = 200;
        $response = [
            "status" => $status,
        ];
        return response()->json($response);
    }
}
