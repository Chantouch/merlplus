<div class="body table-responsive">
    @if(count($tags))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>{!! __('admin.name') !!}</th>
                <th>{!! __('admin.slug') !!}</th>
                <th>{!! __('admin.menu_thumbnail') !!}</th>
                <th>{!! __('admin.thumbnail') !!}</th>
                <th>{!! __('admin.is_menu') !!}</th>
                <th>{!! __('admin.status') !!}</th>
                <th>{!! __('admin.action') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $index => $tag)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>{!! $tag->name !!}</td>
                    <td>{!! $tag->slug !!}</td>
                    <td>
                        @if($tag->hasMenuThumbnail())
                            <img src="{!! asset('storage/uploads/tag/'.$tag->menuThumbnail()->filename) !!}" width="60"
                                 alt="{!! $tag->name !!}" class="img-thumbnail">
                        @endif
                    </td>
                    <td>
                        @if($tag->hasThumbnail())
                            <img src="{!! asset('storage/uploads/tag/'.$tag->thumbnail()->filename) !!}" width="80"
                                 alt="{!! $tag->name !!}" class="img-thumbnail">
                        @endif
                    </td>
                    <td>{!! $tag->is_menu !!}</td>
                    <td>{!! $tag->status !!}</td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['admin.ref.tag.destroy', $tag->id], 'method' => 'delete']) !!}
                            <a href="{!! route('admin.ref.tag.show', [$tag->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                View
                            </a>
                            <a href="{!! route('admin.ref.tag.edit', [$tag->id]) !!}"
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
        {!! $tags->render() !!}
    @else
        <p>There is no data here.</p>
    @endif
</div>