<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class usersdataController extends Controller
{
    //


    public function users(){
        $users = DB::table('users')->get();
        // $collection->put('price', 100);
        // $result=$users->toArray();
        // print_r($result);

        $userslist = DB::table('role_user')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->get();
        $result=$userslist->toArray();
        // print_r($userslist);

        if(empty($result)){    
         return response()->json(['status'=>false,'message' => 'Failed to fetch the record.']);
         }
        else{
         return response()->json(['data' => $result,'status'=>true, 'message' => 'Successfully Retrieved.']);
        }
     }

     public function updateuser(Request $request){
         print_r($request->JSON()->all());
       $data=$request->JSON()->all();

     $result=DB::table('roles')
        ->where('id', $data['role_id'])
        ->update(['name'=> $data['role']]);
    if(empty($result)){
        return response()->json(['status'=>false,'message' => 'Failed to update the record.']);
       }
     else{
        return response()->json(['data' => $result,'status'=>true, 'message' => 'Successfully Updated.']);
      }
    
    }


}
