@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Apps
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($apps, ['route' => ['applications.update', $apps->id], 'method' => 'patch']) !!}

                        @include('apps.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection