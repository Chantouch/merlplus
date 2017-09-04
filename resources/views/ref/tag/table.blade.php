<div class="body table-responsive">
    @if(count($tags))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $index => $tag)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>{!! $tag->name !!}</td>
                    <td>{!! $tag->slug !!}</td>
                    <td>{!! $tag->status !!}</td>
                    <td>
                        {!! Form::open(['route' => ['admin.ref.tag.destroy', $tag->id], 'method' => 'delete']) !!}
                        <a href="{!! route('admin.ref.tag.show', [$tag->id]) !!}"
                           class='btn btn-default btn-xs'>
                            <i class="material-icons">remove_red_eye</i>
                        </a>
                        <a href="{!! route('admin.ref.tag.edit', [$tag->id]) !!}"
                           class='btn btn-default btn-xs'>
                            <i class="material-icons">mode_edit</i>
                        </a>
                        {!! Form::button('<i class="material-icons">delete</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $tags->render() !!}
    @else
        <p>There is no data here.</p>
    @endif
</div>