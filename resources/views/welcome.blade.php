@extends('layouts.index')

@section('content')

    <div class="row form-group">
        @foreach($items as $item)
            <div class="col-xs-6 col-md-3">

                <div class="panel panel-default">

                    <div class="panel-image">
                        <img src="{{asset('images/apps/' . $item->id . '/'. HomeController::getImages($item->id)[2])}}" class="panel-image-preview"/>
                        <label for="toggle-{{$item->id}}"></label>
                    </div>
                    <input type="checkbox" id="toggle-{{$item->id}}" class-"panel-image-toggle">
                    <div class="panel-body">
                        <h4>{{$item->title}}</h4>
                        <div class='starrr star2' id=''>
                            <input type='text' hidden name='rating' value='2' class='star2_input'/>
                        </div>
                        <p>{{$item->description}}</p>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="{{ route('app',['id'=>$item->id]) }}"><span
                                    class="glyphicon glyphicon-download"></span></a>
                        <a href="#facebook"><span class="fa fa-facebook"></span></a>
                        <a href="#twitter"><span class="fa fa-twitter"></span></a>
                        <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
@endsection