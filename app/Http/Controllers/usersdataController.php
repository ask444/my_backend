<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


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
        ->orderBy('users.id', 'asc')
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
       $data=$request->JSON()->all();
     $result=DB::table('role_user')
        ->where('user_id', $data['user_id'])
        ->update(['role_id'=> $data['role'],'updated_at'=>Carbon::now()]);
        if(empty($result)){
        return response()->json(['status'=>false,'message' => 'Failed to update the record.']);
       }
     else{
        return response()->json(['data' => $result,'status'=>true, 'message' => 'Successfully Updated.']);
      }
    
    }

    public function deleteuser(Request $request){
      $data=$request->JSON()->all();
     $result= DB::table('users')
    //  DB::table('role_user')
    //  ->join('users', 'role_user.user_id', '=', 'users.id')
          ->where('id',$data['user_id'])
          ->delete();
          if($result){
             $roledel=  DB::table('role_user')
                  ->where('user_id',$data['user_id'])
                  ->delete();
                  if(empty($roledel)){
                    return response()->json(['status'=>false,'message' => 'Failed to delete the record.']);
                   }
                 else{
                    return response()->json(['data' => $roledel,'status'=>true, 'message' => 'Successfully Deleted.']);
                  }
          }
    }

    public function getadminusers(){
      $users = DB::table('users')->get();
      // $collection->put('price', 100);
      // $result=$users->toArray();
      // print_r($result);

      $userslist = DB::table('role_user')
      ->join('users', 'role_user.user_id', '=', 'users.id')
      ->join('roles', 'role_user.role_id', '=', 'roles.id')
      ->where('roles','role_user.name','!=','SUPERADMIN')
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
}
