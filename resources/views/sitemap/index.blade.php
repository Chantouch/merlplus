<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php
$fullUrl = url(\Illuminate\Support\Facades\Request::getRequestUri());
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<sitemap>
		<loc>{!! route('blog.article.show', [$post->getRouteKey()]) !!}</loc>
		<lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
	</sitemap>
	<sitemap>
		<loc>{!! route('blog.topics.show',[$post->categories->first()->getRouteKey()]) !!}</loc>
		<lastmod>{{ $post->categories->first()->created_at->tz('UTC')->toAtomString() }}</lastmod>
	</sitemap>
</sitemapindex>