<div class="col-md-9 col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0">Article</h3>
        <p class="text-muted m-b-30 font-30">Easy to managing your article</p>
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', 'Article Name:', ['class'=>'col-md-12']) !!}
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
                    <span class="input-group-addon" id="article-slug">https://example.com/article/</span>
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
                    <i class="mdi mdi-camera-iris"></i> Add Media
                </button>
            </div>
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {!! Form::label('description', 'Article Description:', ['class'=>'col-md-12']) !!}
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
                    {!! Form::label('meta_title', 'Meta Title:', ['class'=>'col-md-12']) !!}
                    <span class="col-md-12 m-b-10">Meta title SEO title of page. Title - 50-80 characters (usually - 75)</span>
                    <div class="col-sm-12">
                        @if(isset($post))
                            @if($post->hasMetaTag())
                                {!! Form::text('meta_title', $post->metaTag()->meta_title, ['class' => 'form-control', 'placeholder' => 'Enter your article meta title']) !!}
                            @else
                                {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter your article meta title']) !!}
                            @endif
                        @else
                            {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter your article meta title']) !!}
                        @endif
                        @if ($errors->has('meta_title'))
                            <span class="help-block">
                                <small>{{ $errors->first('meta_title') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('meta_keywords') ? ' has-error' : '' }}">
                    {!! Form::label('meta_keywords', 'Meta keywords:', ['class'=>'col-md-12']) !!}
                    <span class="col-md-12 m-b-10">Keywords - up to 250 characters</span>
                    <div class="col-sm-12">
                        @if(isset($post))
                            @if($post->hasMetaTag())
                                {!! Form::textarea('meta_keywords', $post->metaTag()->meta_keywords, ['class' => 'form-control', 'placeholder' => 'Enter your article meta keywords','rows'=>'7']) !!}
                            @else
                                {!! Form::textarea('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter your article meta keywords','rows'=>'7']) !!}
                            @endif
                        @else
                            {!! Form::textarea('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter your article meta keywords','rows'=>'7']) !!}
                        @endif
                        @if ($errors->has('meta_keywords'))
                            <span class="help-block">
                                <small>{{ $errors->first('meta_keywords') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                    {!! Form::label('meta_description', 'Meta Description:', ['class'=>'col-md-12']) !!}
                    <span class="col-md-12 m-b-10">Description - about 150-200 characters</span>
                    <div class="col-sm-12">
                        @if(isset($post))
                            @if($post->hasMetaTag())
                                {!! Form::textarea('meta_description', $post->metaTag()->meta_description, ['class' => 'form-control', 'placeholder' => 'Enter your article meta description','rows'=>'7']) !!}
                            @else
                                {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => 'Enter your article meta description','rows'=>'7']) !!}
                            @endif
                        @else
                            {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => 'Enter your article meta description','rows'=>'7']) !!}
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
        <div class="panel-heading">Publish
            <div class="panel-action">
                <a href="javascript:void (0);" data-perform="panel-collapse">
                    <i class="ti-minus"></i>
                </a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="row m-b-20">
                    <div class="col-md-6 col-sm-6">
                        @if(!isset($post))
                            <button class="btn btn-outline btn-default waves-effect waves-light pull-left"
                                    name="submit" value="draft">
                                <span>Save as @{{ article.status }}</span>
                            </button>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6">
                        @if(isset($post))
                            <a href="{!! route('blog.article.show',[$post->getRouteKey()]) !!}" target="_blank"
                               class="btn btn-info waves-effect waves-light pull-right" style="margin-right: 0">
                                <span>Preview</span> <i class="fa fa-eye m-l-5"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <p>Status: @{{ article.status }}
                    <a href="javascript:void (0)" @click.prevent="showStatus()" v-if="edit">Edit</a>
                </p>
                <div class="form-group" v-if="status">
                    <label class="col-sm-12" for="status"></label>
                    <input type="hidden" name="status" id="hidden_post_status" :value="article.status">
                    <div class="col-md-7 col-sm-7">
                        <select class="form-control" id="status" v-model="article.status">
                            <option value="pending">Pending Review</option>
                            <option selected value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="row">
                            <a href="javascript:void (0)" class="btn" @click.prevent="changeStatus()">OK</a>
                            <a href="javascript:void (0)" @click.prevent="cancelStatus()">Cancel</a>
                        </div>
                    </div>
                </div>
                <p>Visibility:
                    <a href="javascript:void (0)">Edit</a>
                </p>
                <p>Publish@: @{{ posted_at.now_label }}
                    <a href="javascript:void (0)" @click.prevent="schedulePost" v-if="posted_at.edit">Edit</a>
                </p>
                <div class="form-group" v-if="posted_at.schedule">
                    <label class="col-sm-12" for="status"></label>
                    <input type="hidden" name="posted_at" id="hidden_posted_at" :value="posted_at.now">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="date" class="form-control" v-model="posted_at.date">
                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                        </div>
                    </div>
                    <div class="col-md-7 m-t-15">
                        <div class="input-group">
                            <input type="time" class="form-control" :value="posted_at.time">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                        </div>
                    </div>
                    <div class="col-md-5 m-t-15">
                        <a href="javascript:void (0)" class="btn" @click.prevent="changeStatus()">OK</a>
                        <a href="javascript:void (0)" @click.prevent="cancelStatus()">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <a href="{!! route('admin.article.index') !!}"
                           class="fcbtn btn btn-danger btn-outline btn-1d pull-left">
                            Move to trash
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <button class="fcbtn btn btn-info btn-outline btn-1e pull-right" name="submit" value="publish">
                            <span>Publish</span> <i class="fa fa-save m-l-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Categories-->
    <div class="panel panel-default">
        <div class="panel-heading">Categories
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
                            </span><span class="hidden-xs"> All Categories</span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#most-used" aria-controls="most-used" role="tab" data-toggle="tab"
                           aria-expanded="false">
                            <span class="visible-xs">
                                <i class="ti-user"></i>
                            </span>
                            <span class="hidden-xs">Most Used</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content" style="margin-top: 10px">
                    <div role="tabpanel" class="tab-pane active" id="all-cat">
                        <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input type="hidden" name="categories" :value="article.category">
                                <div class="checkbox checkbox-success" v-for="category in categories.categories">
                                    <input :id="'checkbox-'+category.id" type="checkbox" :value="category.id"
                                           v-model="article.category">
                                    <label :for="'checkbox-'+category.id"> @{{ category.name }} </label>
                                </div>
                                {{--{!! Form::select('categories[]',$categories , null, ['class' => 'select2 m-b-10 select2-multiple', 'multiple', 'data-placeholder'=>'Choose']) !!}--}}
                                @if ($errors->has('categories'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('categories') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="most-used">
                        <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input type="hidden" name="categories" :value="article.category">
                                <div class="checkbox checkbox-success" v-for="category in categories.most_used_cat">
                                    <input :id="'checkbox-'+category.id" type="checkbox" :value="category.id"
                                           v-model="article.category">
                                    <label :for="'checkbox-'+category.id"> @{{ category.name }} </label>
                                </div>
                                {{--{!! Form::select('categories[]',$categories , null, ['class' => 'select2 m-b-10 select2-multiple', 'multiple', 'data-placeholder'=>'Choose']) !!}--}}
                                @if ($errors->has('categories'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('categories') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href="javascript:void (0)" @click.prevent="showCategory()">+ Add New Category</a>
                <p id="category-add" class="category-add hidden-child" v-if="showCat">
                    <label class="screen-reader-text" for="newcategory"></label>
                    <input type="text" name="newcategory" id="newcategory" class="form-control"
                           v-model="newCat.newcategory"
                           placeholder="Add New Category" aria-required="true">
                    <span class="help-block" v-if="formErrors['newcategory']" style="color: red">
                        <small>The name field is required</small>
                    </span>
                    <br>
                    <label class="screen-reader-text" for="new_category_parent">
                        Parent Category: </label>
                    <select name="parent_cat" id="new_category_parent" class="form-control m-b-10"
                            v-model="newCat.parent_cat">
                        <option value="">— Parent Category —</option>
                        <option v-for="category in categories" :value="category.id">
                            @{{ category.name }}
                        </option>
                    </select>
                    <button class="fcbtn btn btn-info btn-outline btn-1e" @click.prevent="newCategory()">
                        <span>Add New Category</span> <i class="fa fa-save m-l-5"></i>
                    </button>
                </p>
            </div>
        </div>
    </div>

    <!--Tag-->
    <div class="panel panel-default">
        <div class="panel-heading">Tag
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
                        <input type="hidden" name="tags" :value="article.tags">
                        <div class="checkbox checkbox-info" v-for="tag in tag_lists">
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

                <div class="input-group m-b-10" :class="{ 'has-error': formErrors['name'] }">
                    <input id="tag-input" class="form-control" placeholder="Tag" v-model="newTag.name">
                    <span class="input-group-btn">
                      <button type="button" class="btn waves-effect waves-light btn-info" @click.prevent="newTags()">
                          Add
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
        <div class="panel-heading">Feature And Background Image
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
                    <label class="col-sm-12">Feature Image (Must 1280x720)</label>
                    <div class="col-sm-12">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="thumbnail" @change.prevent="previewImage" accept="image/*">
                            </span>
                            <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
                               data-dismiss="fileinput" @click.prevent="removeImage">Remove</a>
                        </div>
                        @if ($errors->has('thumbnail'))
                            <span class="help-block">
                                <small>{{ $errors->first('thumbnail') }}</small>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($post))
                    @if(count($post->images))
                        <img src="{!! asset($post->path.$post->images->file) !!}" alt="{!! $post->title !!}"
                             class="img-thumbnail">
                    @endif
                    <div v-if="images.length > 0">
                        <img class="img-thumbnail" :src="images">
                    </div>
                @else
                    <img src="{!! asset('images/not.jpg') !!}" alt="No Image Available"
                         class="img-thumbnail">
                    <div class="img-preview" v-if="images.length > 0">
                        <img class="img-thumbnail" :src="images">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>