<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($method = 'site', $page = 0)
    {
        return view('admin.users.list', ['method'=>$method,'page' => $page]);
    }

    public function edit($id)
    {
        return view('admin.users.edit', ['id'=>$id]);
    }

    public function getEdit($id)
    {
        $user = User::where('id',$id)->first();

        return response()->json($user);
    }

    public function getList($method = 'all',$page,Request $request)
    {
        $list =[];

        switch ($method){
            case 'all':
                $list = User::get();
                break;
            case 'buyers':
                $list = User::where('is_admin',0)->get();
                break;
            case 'admins':
                $list = User::where('is_admin',1)->get();
                break;
        }

        return response()->json(['list' => $list, 'page_list' => range(1, 1), 'page' => $page]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        User::where('id',$id)->update($data);
    }

}
