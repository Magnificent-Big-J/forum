<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Notifications;
class DiscussionController extends Controller
{
    public function create()
    {
        return view('discuss');
    }
    public function store()
    {

         $this->validate(request(),[
            'channel_id'=>'required',
            'contents'=>'required',
            'title'=>'required'
        ]);

       $discussion=  Discussion::create([
            'channel_id'=>request()->channel_id,
            'contents'=>request()->contents,
            'title'=>request()->title,
            'user_id'=>Auth::id(),
            'slug'=> str_slug(request()->title)
        ]);


        Session::flash('success','Discussion successfully created.');

        return redirect()->route('discussion.show',['slug'=>$discussion->slug]);
    }
    public function show($slug)
    {
        $discussion = Discussion::where('slug',$slug)->first();
        $best_answer = $discussion->replies()->where('best_answer',1)->first();
        return view('discussion.show',compact('discussion','best_answer'));
    }
    public function reply($id)
    {
        $this->validate(\request(),[
            'reply'=>'required'
        ]);
        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$d->id,
            'contents'=> request()->reply
        ]);
        $watchers = array();
        $reply->user->points +=20;
        $reply->user->save();
        foreach ($d->watchers as $watcher) {
            array_push( $watchers,User::find($watcher->user_id));
        }
        Notification::send($watchers,new Notifications\NewReplyAdded($d));

        Session::flash('success','Reply successfully created.');

        return redirect()->back();
    }
    public function update($id)
    {
        $this->validate(\request(),[
            'contents'=> 'required'
        ]);

        $d = Discussion::find($id);
        $d->contents = request()->contents;
        $d->save();

        Session::flash('success','Discussion successfully updated.');

        return redirect()->route('discussion.show',['slug'=>$d->slug]);
    }
    public function edit($id)
    {
        $discussion = Discussion::find($id);

        return view('discussion.edit',compact('discussion'));
    }

}
