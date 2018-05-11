<table class="table table-responsive" id="rates-table">
    <thead>
        <tr>
            <th>App Id</th>
        <th>Rate</th>
        <th>Comment</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($rates as $rate)
        <tr>
            <td>{!! $rate->app_id !!}</td>
            <td>{!! $rate->rate !!}</td>
            <td>{!! $rate->comment !!}</td>
            <td>
                {!! Form::open(['route' => ['rates.destroy', $rate->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('rates.show', [$rate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('rates.edit', [$rate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>