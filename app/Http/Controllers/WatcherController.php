<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watcher;
use Illuminate\Support\Facades\Auth;
use Session;
class WatcherController extends Controller
{
    public function watch($id)
    {

        Watcher::create([
            'discussion_id'=>$id,
            'user_id'=>Auth::id()
        ]);

        Session::flash('success','You are watching this discussion');

        return redirect()->back();
    }
    public function unwatch($id)
    {

       $watcher = Watcher::where('discussion_id',$id)
                ->where('user_id',Auth::id())
                ->first();
        $watcher->delete();

        Session::flash('success','You have  unwatched a discussion');

        return redirect()->back();
    }
}
