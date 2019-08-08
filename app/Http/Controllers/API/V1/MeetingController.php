<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\User;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = Meeting::all();
        foreach ($meetings as $meeting) {
            $meeting['created_ago'] =  $meeting->created_at->diffForHumans();
        }
        return $meetings;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Meeting::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting['created_ago'] =  $meeting->created_at->diffForHumans();
        return $meeting;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->update($request->all());

        return $meeting;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();

        return 204;
    }


    public function getList($user_id)
    {
        $meetings = User::find($user_id)->meetings()->get();
        foreach ($meetings as $meeting) {
            $meeting['created_ago'] =  $meeting->created_at->diffForHumans();
            $meeting['owner_name'] = User::find($meeting->owner_id)->name;
        }
        return $meetings;
    }

    public function getDetail($meeting_id)
    {
        return Meeting::find($meeting_id)->users()->get(['name']);
    }
}
