@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update  Channel</div>

                    <div class="card-body">
                        <form action="{{route('channels.update',$channel->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <input type="text" name="channel" class="form-control {{ $errors->has('channel') ? ' is-invalid' : '' }}" value="{{ $channel->title}}">
                                @if ($errors->has('channel'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('channel') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">
                                        Update Channel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
