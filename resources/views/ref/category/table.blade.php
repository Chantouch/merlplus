<div class="body table-responsive">
    @if(count($categories))
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
            @foreach($categories as $index => $category)
                <tr>
                    <th scope="row">{!! $loop->index+1 !!}</th>
                    <td>
                        @if(count($category->images))
                            <img src="{!! asset('uploads/category/'.$category->images->file) !!}"
                                 alt="{!! $category->name !!}" width="25">
                        @else
                            <img src="{!! asset('img/slider-870x323.jpg') !!}" alt="Thumbnail of category"
                                 class="img-thumbnail">
                        @endif
                    </td>
                    <td>{!! $category->name !!}</td>
                    <td>{!! str_limit($category->description, 70) !!}</td>
                    <td>
                        @foreach($category->tags as $tag)
                            <span class="label label-info">{!! $tag->name !!}</span>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge badge-primary">{!! $category->status !!}</span>
                    </td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['route' => ['admin.ref.category.destroy', $category->id], 'method' => 'delete']) !!}
                            <a href="{!! route('admin.ref.category.show', [$category->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                View
                            </a>
                            <a href="{!! route('admin.ref.category.edit', [$category->id]) !!}"
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
        {!! $categories->render() !!}
    @else
        <p>There is no data here.</p>
    @endif
</div>