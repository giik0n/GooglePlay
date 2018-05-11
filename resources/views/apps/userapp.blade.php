@extends('layouts.index')

@section('content')
    <style>
        .card {
            background: #fff;
            padding: 3em;
            line-height: 1.5em;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="card">
        <h4 class="btn btn-danger"><a href="{{ route('apps.uploade') }}"><i class="fa fa-plus" aria-hidden="true"></i>  Add new app</a></h4>
        @include('apps.table')
    </div>
    <script>
        $(document).ready(function () {
            $('.userapp').remove();
        });
    </script>

@endsection