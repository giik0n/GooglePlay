<table class="table table-responsive" id="apps-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Version</th>
        <th>Rate</th>
        <th>Size</th>
        <th>Category</th>
        <th>Android</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($apps as $apps)
        <tr>
            <td>{!! $apps->title !!}</td>
            <td>{!! $apps->version !!}</td>
            <td>{!! round($apps->rate / $apps->ratecount)!!}</td>
            <td>{!! $apps->size !!}</td>
            <td>{!! $apps->category !!}</td>
            <td>{!! $apps->android !!}</td>
            <td>
                {!! Form::open(['route' => ['applications.destroy', $apps->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('applications.show', [$apps->id]) !!}" class='btn btn-default btn-xs userapp'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>