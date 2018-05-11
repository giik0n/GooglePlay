<table class="table table-responsive" id="admins-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Email</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($admins as $admins)
        <tr>
            <td>{!! $admins->name !!}</td>
            <td>{!! $admins->email !!}</td>
            <td>
                {!! Form::open(['route' => ['admins.destroy', $admins->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admins.show', [$admins->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>