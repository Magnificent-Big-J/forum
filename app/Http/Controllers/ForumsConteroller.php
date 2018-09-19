<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Channel;
use Auth;
use Illuminate\Pagination\Paginator;

class ForumsConteroller extends Controller
{
    public function index()
    {
        switch (request('filter'))
        {
            case 'me':
                $discussions = Discussion::where('user_id',Auth::id())->paginate(3);
                break;
            case 'solved':
                    $answered = array();

                    foreach (Discussion::all() as $d)
                    {
                        if($d->hasBestAnswer())
                        {
                            array_push($answered,$d);
                        }
                    }

                    $discussions = new Paginator($answered,3);
                break;
            case 'unsolved':
                $answered = array();

                foreach (Discussion::all() as $d)
                {
                    if(!$d->hasBestAnswer())
                    {
                        array_push($answered,$d);
                    }
                }

                $discussions = new Paginator($answered,3);
                break;
            default:
                $discussions = Discussion::orderBy('created_at','desc')->paginate(3);

        }

        //
        return view('forum',compact('discussions'));
    }
    public function channel($slug)
    {
        $channel = Channel::where('slug',$slug)->first();
        $discussions = $channel->discussions()->paginate(4);

        return view('channel',compact('discussions'));
    }
}
