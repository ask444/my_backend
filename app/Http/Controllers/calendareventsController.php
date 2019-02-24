<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class calendareventsController extends Controller
{
    //

    public function createEvent(Request $request)
    {

        $data = $request->JSON()->all();
        // print_r($data);

        $id = DB::table('calendarevents')->insert(
            ['title' => $data['title'],
                'start' => $data['startdate'],
                'end' => $data['enddate'],
                'color' => $data['primarycolor'],
                'draggable' => $data['draggable'],
                'resizable' => $data['resizable'],
            ]
        );
        if (empty($id)) {
            return response()->json(['status' => false, 'message' => 'Failed to insert row into database.']);
        } else {
            return response()->json(['status' => true, 'message' => 'Saved Successfully', 'data' => array($data)]);
        }

    }

    public function getEventsList()
    {
        $result = DB::table('calendarevents')->get();
        if (empty($result)) {
            return response()->json(['status' => false, 'message' => 'Failed to fetch the record.']);
        } else {
            return response()->json(['data' => $result, 'page_title' => 'Demo Products']);
        }
    }

    public function deleteevent(Request $request)
    {
        $data = $request->JSON()->all();
        // print_r($data);
        // exit;
        $result = DB::table('calendarevents')
            ->where('id', $data['event_id'])
            ->delete();
        if (empty($result)) {
            return response()->json(['status' => false, 'message' => 'Failed to delete the record.']);
        } else {
            return response()->json(['data' => $result, 'status' => true, 'message' => 'Successfully Deleted.']);
        }
    }

    public function updateevent(Request $request)
    {
        $data = $request->JSON()->all();
        $update = DB::table('calendarevents')
            ->where('id', $data['id'])
            ->limit(1)
            ->update(['title' => $data['title'], 'start' => $data['startdate'], 'end' => $data['enddate'], 'color' => $data['primarycolor'], 'draggable' => $data['draggable'], 'resizable' => $data['resizable'], 'updated_at' => Carbon::now()]);
        if (empty($update)) {
            return response()->json(['status' => false, 'message' => 'Failed to update the record.']);
        } else {
            return response()->json(['data' => $update, 'status' => true, 'message' => 'Successfully Updated.']);
        }
    }

}
