<div class="body table-responsive">
    @if(count($pages))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th width="120">Thumbnail</th>
                <th>Name</th>
                <th>Description</th>
                <th>Tags</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $index => $page)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>
                        @if(count($page->images))
                            <img src="{!! asset('uploads/page/'.$page->images->file) !!}"
                                 alt="{!! $page->name !!}" width="25">
                        @else
                            <img src="{!! asset('img/slider-870x323.jpg') !!}" alt="Thumbnail of page"
                                 class="img-thumbnail">
                        @endif
                    </td>
                    <td>{!! $page->name !!}</td>
                    <td>{!! str_limit($page->description, 70) !!}</td>
                    <td>
                        @foreach($page->tags as $tag)
                            <span class="label label-info">{!! $tag->name !!}</span>
                        @endforeach
                    </td>
                    <td>
                        {!! Helper::active($page->status) !!}
                    </td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['admin.ref.page.destroy', $page->id], 'method' => 'delete']) !!}
                            <a href="{!! route('admin.ref.page.show', [$page->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                View
                            </a>
                            <a href="{!! route('admin.ref.page.edit', [$page->id]) !!}"
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
        {!! $pages->render() !!}
    @else
        <p>There is no data here.</p>
    @endif
</div>