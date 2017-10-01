<?php

namespace App\Console\Commands;

use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = Sitemap::create()->add(config('app.url'));
        Post::all()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create(route('blog.article.show', [$post->getRouteKey()])));
        });
        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(Url::create(route('blog.topics.show', [$category->getRouteKey()])));
        });
        Tag::all()->each(function (Tag $tag) use ($sitemap) {
            $sitemap->add(Url::create(route('blog.tag.show',[$tag->getRouteKey()])));
        });
        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap generated at ' . Carbon::now());
    }
}
