@extends('layouts.index')

@section('content')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <style>


        .card {
            background: #fff;
            padding: 3em;
            line-height: 1.5em;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }


    </style>
    <div class="card">
        @include('adminlte-templates::common.errors')
        <div class="col-8">
        <form action="{{route('users.updat')}}" method="POST">
            @csrf
            <div class="form-group row">

                @if(!Auth::user()->developper)
                    <div class="checkbox">
                        <label>
                            <input data-onstyle="success" id="mode" type="checkbox" data-toggle="toggle">
                            Enable developper mode
                        </label>
                    </div>
                    @else
                    <div class="checkbox disabled">
                        <label>
                            <input data-onstyle="success" type="checkbox" checked  disabled data-toggle="toggle">
                           Developper mode is enabled
                        </label>
                    </div>
                    @endif

            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Name</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" id="example-text-input" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Email</label>
                <div class="col-8">
                    <input class="form-control" type="email" value="{{ Auth::user()->email }}" name="email" disabled id="example-email-input">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-password-input" class="col-2 col-form-label">Old Password</label>
                <div class="col-8">
                    <input class="form-control" type="password" name="password" value="" >
                </div>
            </div>
            <div class="form-group row">
                <label for="example-password-input" class="col-2 col-form-label">New Password</label>
                <div class="col-8">
                    <input class="form-control" type="password" value="" name="newpassword" >
                </div>
            </div>
            <div class="form-group row">
                <label for="example-password-input" class="col-2 col-form-label">Confirm Password</label>
                <div class="col-8">
                    <input class="form-control" type="password" value="" name="newpasswordconf" >
                </div>
            </div>

            <div class="form-group row">
                <input type="submit" value="Update" class="form-control btn btn-primary">
            </div>

        </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#mode').on('change',function (e) {
                $.ajax({
                    type: "POST",
                    url: '{!! route("users.setDevelopper") !!}',
                    data: { somefield: "Some field value", _token: '{{csrf_token()}}' },
                    success: function (data) {
                        console.log(data);
                        $(this).prop('disabled', true);
                        location.reload();
                    },
                    error: function (data, textStatus, errorThrown) {
                        console.log(data);

                    },
                });
            });
        });
    </script>

@endsection