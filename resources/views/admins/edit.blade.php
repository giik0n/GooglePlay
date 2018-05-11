@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Admins
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($admins, ['route' => ['admins.update', $admins->id], 'method' => 'patch']) !!}

                        @include('admins.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection