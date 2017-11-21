<div class="col-md-9 col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">{!! __('admin.article') !!}</h3>
        <p class="text-muted m-b-30 font-30">{!! __('admin.easy_to_managing_your_article') !!}</p>
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', __('admin.article_name'), ['class'=>'col-md-12']) !!}
            <div class="col-sm-12">
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter your article title']) !!}
                @if ($errors->has('title'))
                    <span class="help-block">
                        <small>{{ $errors->first('title') }}</small>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
            <label for="basic-url" class="col-md-12">SEO (Slug)</label>
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-addon" id="article-slug">{!! config('app.url').'/article/' !!}</span>
                    {!! Form::text('slug', null, ['class' => 'form-control', 'aria-describedby' => 'slug']) !!}
                </div>
                @if ($errors->has('slug'))
                    <span class="help-block">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" @click.prevent="addMedia">
                    <i class="mdi mdi-camera-iris"></i> {!! __('admin.add_media') !!}
                </button>
            </div>
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {!! Form::label('description', __('admin.article_description'), ['class'=>'col-md-12']) !!}
            <div class="col-sm-12">
                {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter your article description']) !!}
                @if ($errors->has('description'))
                    <span class="help-block">
                        <small>{{ $errors->first('description') }}</small>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!--Feature Image-->
    <div class="panel panel-default">
        <div class="panel-heading">SEO Options
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="form-group{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                    {!! Form::label('meta_title', __('admin.meta_title'), ['class'=>'col-md-12']) !!}
                    <span class="col-md-12 m-b-10">{!! __('admin.meta_title_seo_title_limit') !!}</span>
                    <div class="col-sm-12">
                        @if(isset($post))
                            @if($post->hasMetaTag())
                                {!! Form::text('meta_title', $post->metaTag()->meta_title, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_meta_title')]) !!}
                            @else
                                {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_meta_title')]) !!}
                            @endif
                        @else
                            {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_meta_title')]) !!}
                        @endif
                        @if ($errors->has('meta_title'))
                            <span class="help-block">
                                <small>{{ $errors->first('meta_title') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('meta_keywords') ? ' has-error' : '' }}">
                    {!! Form::label('meta_keywords', __('admin.meta_keyword'), ['class'=>'col-md-12']) !!}
                    <span class="col-md-12 m-b-10">{!! __('admin.keyword_limit') !!}</span>
                    <div class="col-sm-12">
                        @if(isset($post))
                            @if($post->hasMetaTag())
                                {!! Form::textarea('meta_keywords', $post->metaTag()->meta_keywords, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_keyword'),'rows'=>'7']) !!}
                            @else
                                {!! Form::textarea('meta_keywords', null, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_keyword'),'rows'=>'7']) !!}
                            @endif
                        @else
                            {!! Form::textarea('meta_keywords', null, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_keyword'),'rows'=>'7']) !!}
                        @endif
                        @if ($errors->has('meta_keywords'))
                            <span class="help-block">
                                <small>{{ $errors->first('meta_keywords') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                    {!! Form::label('meta_description', __('admin.meta_description'), ['class'=>'col-md-12']) !!}
                    <span class="col-md-12 m-b-10">{!! __('admin.meta_description_limit') !!}</span>
                    <div class="col-sm-12">
                        @if(isset($post))
                            @if($post->hasMetaTag())
                                {!! Form::textarea('meta_description', $post->metaTag()->meta_description, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_meta_description'),'rows'=>'7']) !!}
                            @else
                                {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_meta_description'),'rows'=>'7']) !!}
                            @endif
                        @else
                            {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => __('admin.enter_your_article_meta_description'),'rows'=>'7']) !!}
                        @endif
                        @if ($errors->has('meta_description'))
                            <span class="help-block">
                                <small>{{ $errors->first('meta_description') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-12">
    <!--Publish-->
    <div class="panel panel-default">
        <div class="panel-heading">{!! __('admin.publish') !!}
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <a href="{!! route('admin.article.index') !!}"
                           class="fcbtn btn btn-danger btn-outline btn-1d pull-left">
                            {!! __('admin.move_to_draft') !!}
                        </a>
                        <button class="fcbtn btn btn-info btn-outline btn-1e pull-right" name="submit"
                                value="publish">
                            <span>{!! __('admin.publish') !!}</span> <i class="fa fa-save m-l-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Categories-->
    <div class="panel panel-default">
        <div class="panel-heading">{!! __('admin.categories') !!}
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#all-cat" aria-controls="all-cat" role="tab" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs">
                                <i class="ti-home"></i>
                            </span><span class="hidden-xs"> {!! __('admin.all_categories') !!}</span>
                        </a>
                    </li>
                    <li role="presentation" class="" v-if="categories.most_used_cat > 0">
                        <a href="#most-used" aria-controls="most-used" role="tab" data-toggle="tab"
                           aria-expanded="false">
                            <span class="visible-xs">
                                <i class="ti-user"></i>
                            </span>
                            <span class="hidden-xs">{!! __('admin.most_used') !!}</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content" style="margin-top: 10px">
                    <div role="tabpanel" class="tab-pane active" id="all-cat">
                        <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <div class="category-field slimscrollright">
                                    <input type="hidden" name="categories" :value="article.category">
                                    <div class="checkbox checkbox-success" v-for="category in categories.categories">
                                        <input :id="'checkbox-'+category.id" type="checkbox" :value="category.id"
                                               v-model="article.category">
                                        <label :for="'checkbox-'+category.id"> @{{ category.name }} </label>
                                    </div>
                                    @if ($errors->has('categories'))
                                        <span class="help-block">
                                            <small>{{ $errors->first('categories') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="most-used">
                        <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <div class="category-field slimscrollright">
                                    <input type="hidden" name="categories" :value="article.category">
                                    <div class="checkbox checkbox-success" v-for="category in categories.most_used_cat">
                                        <input :id="'checkbox-'+category.id" type="checkbox" :value="category.id"
                                               v-model="article.category">
                                        <label :for="'checkbox-'+category.id"> @{{ category.name }} </label>
                                    </div>
                                    @if ($errors->has('categories'))
                                        <span class="help-block">
                                            <small>{{ $errors->first('categories') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href="javascript:void (0)" @click.prevent="showCategory()">+ {!! __('admin.add_new_category') !!}</a>
                <p id="category-add" class="category-add hidden-child" v-if="showCat">
                    <label class="screen-reader-text" for="newcategory"></label>
                    <input type="text" name="newcategory" id="newcategory" class="form-control"
                           v-model="newCat.newcategory"
                           placeholder="{!! __('posts.name') !!}" aria-required="true">
                    <span class="help-block" v-if="formErrors['newcategory']" style="color: red">
                        <small>{!! __('posts.the_name_field_is_required') !!}</small>
                    </span>
                    <br>
                    <label class="screen-reader-text" for="new_category_parent">
                        {!! __('admin.parent_category') !!}: </label>
                    <select name="parent_cat" id="new_category_parent" class="form-control m-b-10"
                            v-model="newCat.parent_cat">
                        <option value="">— {!! __('admin.parent_category') !!} —</option>
                        <option v-for="category in categories.categories" :value="category.id">
                            @{{ category.name }}
                        </option>
                    </select>
                    <button class="fcbtn btn btn-info btn-outline btn-1e" @click.prevent="newCategory()">
                        <span>{!! __('admin.add_new_category') !!}</span> <i class="fa fa-save m-l-5"></i>
                    </button>
                </p>
            </div>
        </div>
    </div>

    <!--Tag-->
    <div class="panel panel-default">
        <div class="panel-heading">{!! __('posts.tag') !!}
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="form-group tagsinput-area">
                    <label class="col-sm-12" for="tag"></label>
                    <div class="col-md-12">
                        <div class="tag-field slimscrollright">
                            <input type="hidden" name="tags" :value="article.tags">
                            <div class="checkbox checkbox-info" v-for="tag in tag_lists.tags">
                                <input :id="'tag-'+tag.id" type="checkbox" :value="tag.id"
                                       v-model="article.tags">
                                <label :for="'tag-'+tag.id"> @{{ tag.name }} </label>
                            </div>
                            @if ($errors->has('tags'))
                                <span class="help-block">
                                    <small>{{ $errors->first('tags') }}</small>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="input-group m-b-10" :class="{ 'has-error': formErrors['name'] }">
                    <input id="tag-input" class="form-control" placeholder="{!! __('posts.name') !!}" v-model="newTag.name">
                    <span class="input-group-btn">
                      <button type="button" class="btn waves-effect waves-light btn-info" @click.prevent="newTags()">
                          {!! __('admin.add') !!}
                      </button>
                    </span>
                </div>
                <span class="help-block" v-if="formErrors['name']" style="color: red">
                    <small>@{{ formErrors['name'][0] }}</small>
                </span>
            </div>
        </div>
    </div>

    <!--Feature Image-->
    <div class="panel panel-default">
        <div class="panel-heading">{!! __('admin.feature_and_background_image') !!}
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <!--Feature image-->
                <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
                    <label class="col-sm-12">{!! __('admin.feature_image_size') !!}</label>
                    <div class="col-sm-12">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">{!! __('posts.select_file') !!}</span>
                                <span class="fileinput-exists">{!! __('posts.change') !!}</span>
                                <input type="file" name="thumbnail" @change.prevent="previewImage" accept="image/*">
                            </span>
                            <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
                               data-dismiss="fileinput" @click.prevent="removeImage">{!! __('admin.remove') !!}</a>
                        </div>
                        @if ($errors->has('thumbnail'))
                            <span class="help-block">
                                <small>{{ $errors->first('thumbnail') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($post))
                    @if(count($post->media))
                        <div v-if="images.length > 0">
                            <img class="img-thumbnail" :src="images" alt="Image thumbnail">
                        </div>
                    @endif
                @else
                    <div class="img-preview" v-if="images.length > 0">
                        <img class="img-thumbnail" :src="images" alt="Image thumbnail">
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- publish of article-->
    <div class="panel panel-default">
        <div class="panel-heading">{!! __('admin.publish') !!}
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group text-center pull-right">
                            <button class="fcbtn btn btn-primary btn-outline btn-1d pull-left" name="submit"
                                    value="draft">
                                <span>{!! __('admin.save_as_draft') !!}</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group text-center pull-right">
                            <button class="fcbtn btn btn-info btn-outline btn-1e pull-right" name="submit"
                                    value="publish">
                                <span>{!! __('admin.publish') !!}</span> <i class="fa fa-save m-l-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Resource of article-->
    <div class="panel panel-default">
        <div class="panel-heading">
            {!! __('posts.resource_Contributor') !!}
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <!--Source -->
                        <div class="form-group{{ $errors->has('origin_source') ? ' has-error' : '' }}">
                            {!! Form::label('origin_source', __('posts.origin_source'), ['class'=>'col-md-12']) !!}
                            <div class="col-sm-12">
                                {!! Form::text('origin_source', null, ['class' => 'form-control', 'placeholder' => __('posts.enter_your_article_origin_source_form')]) !!}
                                @if ($errors->has('origin_source'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('origin_source') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('source_title') ? ' has-error' : '' }}">
                            {!! Form::label('source_title', __('posts.source_title'), ['class'=>'col-md-12']) !!}
                            <div class="col-sm-12">
                                {!! Form::text('source_title', null, ['class' => 'form-control', 'placeholder' => __('posts.enter_your_article_origin_source_title')]) !!}
                                @if ($errors->has('source_title'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('source_title') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--Contributor-->
                        <div class="form-group{{ $errors->has('contributor') ? ' has-error' : '' }}">
                            {!! Form::label('contributor', __('posts.contributor'), ['class'=>'col-md-12']) !!}
                            <div class="col-sm-12">
                                {!! Form::text('contributor', null, ['class' => 'form-control', 'placeholder' => __('posts.enter_your_article_contributor')]) !!}
                                @if ($errors->has('contributor'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('contributor') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>