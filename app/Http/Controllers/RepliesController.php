<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use App\Like;
use Auth;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{
    public function like($id)
    {
      Like::create([
          'reply_id'=>$id,
          'user_id'=> Auth::id()
      ]);
        Session::flash('success','Reply successfully liked.');

        return redirect()->back();
    }
    public function unlike($id)
    {
        $like = Like::where('reply_id',$id)
                    ->where('user_id',Auth::id())
                    ->first();
        $like->delete();
        Session::flash('success','Reply successfully unliked.');

        return redirect()->back();
    }
    public function bestAnswer($id)
    {
        $reply = Reply::find($id);
        $reply->best_answer = 1;
        $reply->save();

        Session::flash('success','Reply is marked as best answer.');

        return redirect()->back();
    }
    public function edit($id)
    {
        $reply = Reply::find($id);

        return view('reply.edit',compact('reply'));
    }
    public function update($id)
    {
        $this->validate(request(),[
            'contents'=>'required'
        ]);
        $reply = Reply::find($id);
        $reply->contents = request()->contents;
        $reply->save();
        $slug = $reply->discussion->slug;

        Session::flash('success','Reply successfully updated.');

        return redirect()->route('discussion.show',compact('slug'));
    }

}
