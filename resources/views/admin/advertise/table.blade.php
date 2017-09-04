<div class="body table-responsive">
    @if(count($advertises))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Name</th>
                <th>Ad Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($advertises as $index => $advertise)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>{!! $advertise->slug !!}</td>
                    <td>{!! $advertise->provider_name !!}</td>
                    <td>{!! $advertise->ads_type->name !!}</td>
                    <td>
                        {!! status($advertise->active) !!}
                    </td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['admin.advertise.destroy', $advertise->id], 'method' => 'delete']) !!}
                            <a href="{!! route('admin.advertise.show', [$advertise->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                View
                            </a>
                            <a href="{!! route('admin.advertise.edit', [$advertise->id]) !!}"
                               class='btn btn-primary btn-outline waves-effect btn-xs'>
                                Edit
                            </a>
                            {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-outline waves-effect btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $advertises->render() !!}
    @else
        <p>There is no data here.</p>
    @endif
</div>