@extends('layouts.index')

@section('content')
    <style>
        .form {
            display: block;
            margin: 20px auto;
            background: #eee;
            border-radius: 10px;
            padding: 15px
        }

        .progress {
            padding: 30px;
            position: relative;
            width: 100%;
            border: 1px solid #ddd;
            padding: 1px;
            border-radius: 3px;
        }

        .bar {
            background-color: #B4F5B4;
            width: 0%;
            height: 50px;
            border-radius: 3px;
        }

        .percent {
            font-weight: bolder;
            font-size: 1.5em;
            position: absolute;
            display: inline-block;
            top: 25%;
            left: 48%;
        }

        .card {
            background: #fff;
            padding: 3em;
            line-height: 1.5em;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        [hidden] {
            display: none !important;
        }
    </style>
    <div class="card">
        <h1 class="text-center">Create new app</h1>

        <h3>Choose .apk file</h3>
        <form class="form form-horizontal" action="{{ route('fileuploade') }}" method="post"
              enctype="multipart/form-data">
            @csrf
            <div style="position:relative;">
                <a class='btn btn-primary' href='javascript:;'>
                    Choose File...
                    <input required id="apkfile" name="myfile" type="file"
                           style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;'
                           name="file_source" size="40" onchange='$("#upload-file-info").html($(this).val());'>
                </a>
                &nbsp;
                <span class='label label-info' id="upload-file-info"></span>
            </div>
            <br>
            <input class="form-control btn btn-warning" type="submit" value="Upload File to Server">
        </form>

        <div style="height: 50px;" class="progress">
            <div class="bar"></div>
            <div class="percent">0%</div>
        </div>

        <div id="status"></div>
        <div id="store" style="display: none;" class="box-body">
            <div class="row">
            {!! Form::open(['route' => 'applications.storeApp','files'=>true]) !!}


            <!-- Title Field -->
                <div class="form-group col-sm-6">
                    <label for="title">Title:</label>
                    <input class="form-control" name="title" type="text" id="title">
                </div>
                <div class="form-group col-sm-6">
                    <label for="title">Choose images:</label>
                            <input required name="images[]" type="file" accept="image/x-png,image/gif,image/jpeg" multiple>
                    </div>
                <!-- Description Field -->
                <div class="form-group col-sm-12 col-lg-12">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" cols="50" rows="10" id="description"></textarea>
                </div>

                <input hidden class="form-control" name="user_id" value="{{Auth::user()->id}}" type="number" id="user_id">
                <input hidden class="form-control" name="user_email" value="{{Auth::user()->email}}" type="email"
                       id="user_email">
                <input hidden class="form-control" name="download" value="0" type="number" id="download">
                <input hidden class="form-control" value="0" name="rate" type="number">

                <!-- Version Field -->
                <div class="form-group col-sm-6">
                    <label for="version">Version:</label>
                    <input class="form-control" name="version" type="text" id="version">
                </div>
                <!-- Size Field -->
                <div class="form-group col-sm-6">
                    <label for="size">Size:</label>
                    <input class="form-control" name="size" type="number" id="size">
                </div>

                <!-- Company Field -->
                <div class="form-group col-sm-6">
                    <label for="company">Company:</label>
                    <input class="form-control" name="company" type="text" id="company">
                </div>
                <!-- Category Field -->
                <div class="form-group col-sm-6">
                    <label for="category">Category:</label>
                    <select class="form-control" name="category">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Android Field -->
                <div class="form-group col-sm-6">
                    <label for="android">Android:</label>
                    <input class="form-control" name="android" type="text" id="android">
                </div>

                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    <input class="btn btn-primary form-control" type="submit" value="Save">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <h6>&emsp;</h6>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {

            (function () {

                var bar = $('.bar');
                var percent = $('.percent');
                var status = $('#status');

                $('.form').ajaxForm({
                    beforeSend: function () {
                        status.empty();
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    success: function () {
                        var percentVal = '100%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    complete: function (xhr) {
                        //status.html(xhr.responseText);
                        $('#store').fadeIn(800, function() {
                            $('#store').css('display', display);
                        });
                    }
                });

            })();


        });
    </script>
    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
    <script type="text/javascript">
        _uacct = "UA-850242-2";
        urchinTracker();
    </script>
@endsection