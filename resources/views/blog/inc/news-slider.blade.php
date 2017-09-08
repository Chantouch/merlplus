<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:59 PM
 */
?>
<ul class="slides">
    @if(isset($posts))
        @if(count($posts))
            @foreach($posts as $post)
                <li>
                    <div class="trans2 slide-sngl">
                        <a class="text-center" href="#">
                            <img alt="Image blog default page" src="{!! asset('blog/img/samples/s1.jpg') !!}"/>
                        </a>
                        <h4><a href="#">Listen during running</a></h4>
                        <p>
                            Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit ...
                        </p>
                        <h6>
                            <span><i class="fa fa-clock-o"></i>{!! $post->created_at->format('d M Y') !!}</span>
                        </h6>
                    </div>
                </li>
            @endforeach
        @endif
    @endif
</ul>
