@extends('layouts.app')

@section('content')



            <div class="card mb-2">
                <div class="card-header">
                    <img src="{{asset($discussion->user->avatar)}}" width="40px" height="40px">
                    <span>{{$discussion->user->name}}, <b>({{$discussion->user->points}})</b> </span>
                    @if(Auth::id())
                        <a href="{{route('discussion.edit',$discussion->id)}}" class="btn btn-default btn-xs pull-right">Edit</a>
                     @endif
                    @if($discussion->is_being_watched_by_auth_user())
                        <a href="{{route('discussion.unwatch',$discussion->id)}}" class="btn btn-default btn-xs pull-right">Unwatch</a>
                    @else
                        <a href="{{route('discussion.watch',$discussion->id)}}" class="btn btn-default btn-xs pull-right">Watch</a>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="text-center text-dark">
                        <b>{{$discussion->title}}</b>
                    </h4>
                    <hr>
                    <p class="text-center">
                        {{$discussion->contents}}
                    </p>

                    @if($best_answer)
                        <hr>
                        <div class="text-center" style="padding: 40px;">
                            <div class="card">
                                <div class="card-header">
                                    <img src="{{asset($discussion->user->avatar)}}" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                                    <span>{{$discussion->user->name}}</span>
                                </div>
                                <div class="card-body">
                                    {{$best_answer->contents}}
                                </div>
                            </div>
                        </div>
                    @endif
                     <hr>
                </div>
                <div class="card-footer">
                     <p>
                        {{$discussion->replies->count()}} Replies
                    </p>
                </div>
            </div>


        @foreach($discussion->replies as $r)

                <div class="card mb-2">
                    <div class="card-header">
                        <img src="{{asset($r->user->avatar)}}" width="40px" height="40px">
                        <span>{{$r->user->name}}, <b>{{$r->created_at->diffForHumans()}}</b> </span>
                        @if(!$best_answer)
                           @if(Auth::id() == $discussion->user->id )
                            <a href="{{route('reply.bestAnswer',$r->id)}}" class="btn btn-info btn-xs pull-right">Mark as best answer</a>

                            @endif

                        @endif
                        @if(Auth::id() == $r->user->id )
                            @if(!$r->best_answer)
                                <a href="{{route('reply.edit',$r->id)}}" class="btn btn-info btn-xs pull-right">Edit</a>
                            @endif
                        @endif
                        @if($r->best_answer)

                            <span class="pull-right text-info">Marked as best answer</span>

                        @endif

                    </div>
                    <div class="card-body">

                        <p class="text-center">
                            {{$r->contents}}
                        </p>
                    </div>
                    <div class="card-footer">

                        @if($r->is_liked_by_auth_user())
                            <a href="{{route('reply.unlike',$r->id)}}"><span><i class="fa fa-thumbs-o-down col-1"></i></span>
                            </a>
                            <span class="badge badge-info">{{$r->likes->count()}}</span>
                        @else
                            <a href="{{route('reply.like',$r->id)}}"><span><i class="fa fa-thumbs-o-up col-1"></i></span>
                            </a>
                            <span class="badge badge-info">{{$r->likes->count()}}</span>
                         @endif



                    </div>
                </div>


        @endforeach
        <div class="card">
            <div class="card-body">
               @if(Auth::check())
                    <form action="{{route('discussion.reply',$discussion->id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Leave a Reply</label>
                            <textarea name="reply" id="reply" cols="30" rows="10" class="form-control" {{ $errors->has('reply') ? ' is-invalid' : '' }}></textarea>
                            @if ($errors->has('reply'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reply') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Leave a reply</button>
                        </div>
                    </form>
               @else
                    <div class="text-center">
                        sign in to leave a comment
                    </div>
                @endif
            </div>
        </div>
@endsection
