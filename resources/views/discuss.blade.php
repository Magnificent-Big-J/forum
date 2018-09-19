@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">Create a new discussion</div>

            <div class="card-body">
                <form action="{{route('discussion.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Channel</label>
                        <select name="channel_id" id="channel_id" class="form-control">
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}">{{$channel->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ask a question</label>
                        <textarea name="contents" id="contents" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success pull-right" type="submit">Create discussion</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
