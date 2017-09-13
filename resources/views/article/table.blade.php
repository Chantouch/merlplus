<div class="body table-responsive">
    @if(count($articles))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th width="120">Thumbnail</th>
                <th>Name</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $index => $article)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>
                        @if($article->hasThumbnail())
                            <img src="{!! asset(route('media.posts.path',[$article->id,'small_'.$article->thumbnail()->filename])) !!}"
                                 alt="{!! $article->title !!}" width="50">
                        @else
                            <img src="{!! asset('img/slider-870x323.jpg') !!}" alt="Thumbnail of page"
                                 class="img-thumbnail">
                        @endif
                    </td>
                    <td>{!! str_limit($article->title, 100) !!}</td>
                    <td>
                        @if($article->categories->count())
                            @foreach($article->categories as $category)
                                <span class="label label-primary">
                                    {!! $category->name !!}
                                </span>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @foreach($article->tags as $tag)
                            <span class="label label-info">{!! $tag->name !!}</span>
                        @endforeach
                    </td>
                    <td>
                        {!! $article->active !!}
                    </td>
                    <td>
                        <div class="btn-group" style="white-space: nowrap">
                            {!! Form::open(['route' => ['admin.article.destroy', $article->id], 'method' => 'delete']) !!}
                            <a href="{!! route('admin.article.show', [$article->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                View
                            </a>
                            <a href="{!! route('admin.article.edit', [$article->id]) !!}"
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
        {!! $articles->render() !!}
    @else
        <p>There is no data here.</p>
    @endif
</div>