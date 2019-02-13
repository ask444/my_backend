<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
class calendareventsController extends Controller
{
    //

public function createEvent(Request  $request){
    
    $data=$request->JSON()->all();
    print_r($data);


  $id=  DB::table('calendarevents')->insert(
        ['title' => $data['title'],
        'start'=>$data['startdate'],
        'end'=>$data['enddate'],
        'color'=>$data['primarycolor'],
        'draggable'=>$data['draggable'],
        'resizable'=>$data['resizable']
        ]
    );
    if(empty($id)){    
        return response()->json(['status'=>false,'message' => 'Failed to insert row into database.']);
     }
     else{
        return response()->json(['status'=>true,'message' => 'Saved Successfully']);
     }
     
}

}
