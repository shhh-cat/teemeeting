<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public $successStatus = 200;

    public function findUser(String $type , String $data)
    {
        if (empty($data)) {
                    $query = [];
        } else {

            // Except for yourself and the friend requests you sent
            $except = Auth::user()->getPendingFriendships()->pluck(['recipient_id'])->toArray();
            array_push($except,Auth::id());
            $except = array_merge($except,Auth::user()->getFriends()->pluck(['id'])->toArray());


            switch ($type) {
            case 'id':
                $query = User::where('id','like','%'.$data.'%')->get()->except($except);
                break;

            case 'name':
                $query = User::where('name','like','%'.$data.'%')->get()->except($except);
                break;
            default:
                break;
            }
        }
        
        return response()->json($query, $this->successStatus);
    }

    public function addFriend(Request $request)
    {
        $self = User::find($request->self);
        $recipient = User::find($request->recipient);
        $self->befriend($recipient);
        return response()->json($recipient, $this->successStatus);
    }

    public function getFriendRequests()
    {
        $friendrequests = Auth::user()->getFriendRequests();
        foreach ($friendrequests as $value) {
            $value['name'] = User::find($value->sender_id)->name;
            $value['sent_at'] = $value->updated_at->diffForHumans();
        }
        return response()->json($friendrequests, $this->successStatus);
    }

    public function responseRequest(Request $request)
    {
        $self = User::find($request->self);
        $object = User::find($request->object);
        switch ($request->type) {
            case 3:
                $self->blockFriend($object);
                break;
            case 2:
                $self->unfriend($object);
                break;
            case 1:
                $self->acceptFriendRequest($object);
                break;
            case 0:
                $self->denyFriendRequest($object);
                break;
            default:
                # code...
                break;
        }
        return response()->json('ok', $this->successStatus);
    }

    public function getFriends()
    {
        return response()->json(Auth::user()->getFriends(), $this->successStatus);
    }

}
