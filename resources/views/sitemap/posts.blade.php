<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php
$fullUrl = url(\Illuminate\Support\Facades\Request::getRequestUri());
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <url>
            <loc>{!! route('blog.article.show', [$post->getRouteKey()]) !!}</loc>
            <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>