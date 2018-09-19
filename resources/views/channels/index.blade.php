@extends('layouts.app')

@section('content')
    <div class="container">

                <div class="card">
                    <div class="card-header">Channels</div>

                    <div class="card-body">
                       <table class=" table table-hover">
                           <thead>
                               <th>Name</th>
                               <th>Edit</th>
                               <th>Delete</th>
                           </thead>
                           <tbody>
                            @if($channels->count())
                                   @foreach($channels as $channel)
                                       <tr>
                                           <td>{{$channel->title}}</td>
                                           <td><a href="{{route('channels.edit',$channel->id)}}" class="btn btn-info btn-sm"> <span> <i class="fa fa-edit"></i></span></a> </td>
                                           <td>
                                               <form action="{{route('channels.destroy',$channel->id)}}" method="post">
                                                   {{csrf_field()}}
                                                   {{method_field('DELETE')}}
                                                   <button  class="btn btn-danger btn-sm" type="submit"><span><i class="fa fa-trash"></i></span></button>
                                               </form>


                                           </td>
                                       </tr>
                               @endforeach
                                @else
                                <tr>
                                    <td colspan="3" class="text-center text-info">No Channels</td>
                                </tr>
                                @endif
                           </tbody>
                       </table>
                    </div>
                </div>

    </div>
@endsection
