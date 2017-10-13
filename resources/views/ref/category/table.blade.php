<div class="body table-responsive">
    @if(count($categories))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th width="120">{!! __('admin.thumbnail') !!}</th>
                <th>{!! __('admin.name') !!}</th>
                <th>{!! __('admin.description') !!}</th>
                <th>{!! __('admin.tags') !!}</th>
                <th>{!! __('admin.order') !!}</th>
                <th>{!! __('admin.status') !!}</th>
                <th>{!! __('admin.action') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $index => $category)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>
                        @if($category->hasThumbnail())
                            <img src="{!! asset('storage/uploads/category/'.$category->thumbnail()->filename) !!}"
                                 alt="{!! $category->name !!}" width="50">
                        @endif
                    </td>
                    <td>{!! $category->name !!}</td>
                    <td>{!! str_limit($category->description, 70) !!}</td>
                    <td>
                        @foreach($category->tags as $tag)
                            <span class="label label-info">{!! $tag->name !!}</span>
                        @endforeach
                    </td>
                    <td>{!! $category->position_order !!}</td>
                    <td>
                        <span class="badge badge-primary">{!! $category->status !!}</span>
                    </td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['admin.ref.category.destroy', $category->id], 'method' => 'delete']) !!}
                            <a href="{!! route('admin.ref.category.edit', [$category->id]) !!}"
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
        {!! $categories->render() !!}
    @else
        <p>{!! __('app.table.no_data') !!}</p>
    @endif
</div>