@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">Update reply</div>

            <div class="card-body">
                <form action="{{route('reply.update',$reply->id)}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="">Ask a question</label>
                        <textarea name="contents" id="contents" cols="30" rows="10" class="form-control">{{$reply->contents}}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success pull-right" type="submit">Save reply</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
