<div class="row">
    @if(count($latest_posts))
        @foreach($latest_posts as $latest_post)
            <div class="col-md-6 col-lg-3 col-xs-12 col-sm-6">
                <img class="img-responsive" alt="{!! $latest_post->title !!}"
                     src="{!! asset(route('media.posts.path',[$latest_post->id,'medium_'.$latest_post->thumbnail()->filename])) !!}">
                <div class="white-box">
                    <div class="text-muted">
                        <span class="m-r-10">
                            <i class="icon-calender"></i> {!! $latest_post->posted_at->format('M d,Y') !!}
                        </span>
                        <a class="text-muted m-l-10" href="#">
                            <i class="fa fa-user"></i> {!! $latest_post->checkAuthor()? $latest_post-> author->name : 'Admin' !!}
                        </a>
                    </div>
                    <h3 class="m-t-20 m-b-20">{!! $latest_post->excerptTitle(50) !!}</h3>
                    <p>{!! $latest_post->excerpt(450) !!}</p>
                    <a href="{!! route('blog.article.show', [$latest_post->getRouteKey()]) !!}"
                       class="btn btn-success btn-rounded waves-effect waves-light m-t-20" target="_blank">
                        {!! __('posts.btn_read_more') !!}
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</div>
