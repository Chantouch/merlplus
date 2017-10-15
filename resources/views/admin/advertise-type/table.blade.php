<div class="body table-responsive">
    @if(count($advertise_types))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>{!! __('admin.name') !!}</th>
                <th>{!! __('admin.slug') !!}</th>
                <th>{!! __('admin.size') !!}</th>
                <th>{!! __('admin.status') !!}</th>
                <th>{!! __('admin.action') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($advertise_types as $index => $advertise_type)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>{!! $advertise_type->name !!}</td>
                    <td>{!! $advertise_type->slug !!}</td>
                    <td>{!! $advertise_type->width.'x'.$advertise_type->height !!}</td>
                    <td>
                        {!! status($advertise_type->active) !!}
                    </td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['admin.advertise-type.destroy', $advertise_type->id], 'method' => 'delete']) !!}
                            <a href="{!! route('admin.advertise-type.show', [$advertise_type->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                {!! __('admin.view') !!}
                            </a>
                            <a href="{!! route('admin.advertise-type.edit', [$advertise_type->id]) !!}"
                               class='btn btn-primary btn-outline waves-effect btn-xs'>
                                {!! __('admin.edit') !!}
                            </a>
                            {!! Form::button(__('admin.delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-outline waves-effect btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $advertise_types->render() !!}
    @else
        <p>There is no data here.</p>
    @endif
</div>