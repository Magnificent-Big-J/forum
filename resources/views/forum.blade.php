@extends('layouts.app')

@section('content')

    @foreach($discussions as $d)
        <div class="card mb-2">
            <div class="card-header">
                <img src="{{$d->user->avatar}}" width="40px" height="40px">
                <span>{{$d->user->name}}, <b>{{$d->created_at->diffForHumans()}}</b> </span>
                @if($d->hasBestAnswer())
                    <span class="btn btn-success pull-right btn-xs mr-2">CLOSED</span>
                @else
                    <span class="btn btn-danger pull-right btn-xs mr-2">OPEN</span>
                 @endif
                <a href="{{route('discussion.show',$d->slug)}}" class="btn btn-default pull-right"><span><i class="fa fa-eye"></i></span></a>
            </div>
            <div class="card-body">
                <h4 class="text-center text-dark">
                   <b>{{$d->title}}</b>
                    {{$d->id}}
                </h4>
                <p class="text-center">
                    {{str_limit($d->contents,50)}}
                </p>
            </div>
            <div class="card-footer">
                <p>
                    {{$d->replies->count()}} Replies
                </p>
            </div>
        </div>
    @endforeach
    <div class="text-center">
        {{$discussions->links()}}
    </div>
@endsection
