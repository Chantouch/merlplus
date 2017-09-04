<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/28/2017
 * Time: 1:17 PM
 */
?>
@section('style')
    <style>

        .input-hidden {
            position: absolute;
            left: -9999px;
        }

        input[type=radio]:checked + label > img {
            border: 1px solid #fff;
            box-shadow: 0 0 3px 3px #090;
        }

        /* Stuff after this is only to make things more pretty */
        input[type=radio] + label > img {
            border: 1px dashed #444;
            width: 150px;
            height: 120px;
            transition: 500ms all;
        }

        input[type=radio]:checked + label > img {
            transform: rotateZ(-10deg) rotateX(10deg);
        }

    </style>
@stop
<div id="add-media" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Media Library</h4></div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#media-library" aria-controls="media-library" role="tab" data-toggle="tab"
                           aria-expanded="true" @click.prevent="getMediaLibrary">
                            <span class="visible-xs"><i class="ti-home"></i></span>
                            <span class="hidden-xs"> Media Library</span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#upload-files" aria-controls="upload-files" role="tab" data-toggle="tab"
                           aria-expanded="false">
                            <span class="visible-xs"><i class="ti-user"></i></span>
                            <span class="hidden-xs">Upload Files</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="media-library">
                        <div class="col-md-9 col-sm-9">
                            <h4 class="box-title m-b-0">Media Files Uploaded</h4>
                            <p class="text-muted m-b-10"> Select any file to keep to article</p>
                            <div class="row">
                                <div id="media-library-slim">
                                    <span v-for="media in mediaLibrary.data">
                                        <input type="radio" name="media_library" :id="media.id" class="input-hidden"
                                               @change.prevent="mediaLibraryDetail(media.id)"/>
                                        <label :for="media.id">
                                            <img :src="media.attributes.url" :alt="media.attributes.alt_text"/>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3" v-if="mediaLibraryDetailsChecked">
                            <h4 class="box-title m-b-0">Media Details</h4>
                            <p class="text-muted m-b-10">Media Deep details insider</p>
                            <div class="attachment-info">
                                <div class="thumbnail">
                                    <img :src="mediaLibraryDetails.url" :alt="mediaLibraryDetails.alt_text">
                                </div>
                                <div class="details">
                                    <div class="filename">@{{ mediaLibraryDetails.limit_name + '.' +
                                        mediaLibraryDetails.mime_type }}
                                    </div>
                                    <div class="uploaded">@{{ mediaLibraryDetails.uploaded_at }}</div>
                                    <div class="file-size">364 kB</div>
                                    <div class="dimensions">1200 × 799</div>
                                    <a class="edit-attachment" href="" target="_blank">Edit Image</a>
                                    <button type="button" class="btn btn-danger waves-effect"
                                            @click="deleteMediaLibrary(mediaLibraryDetails.id)">
                                        Delete Permanently
                                    </button>
                                    <div class="compat-meta">

                                    </div>
                                </div>
                            </div>
                            <form action="#" class="form-horizontal">
                                <div class="form-group">
                                    <label for="url" class="col-md-12">URL</label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control input-sm" id="url" readonly
                                                   :value="mediaLibraryDetails.url" ref="url">
                                            <div class="input-group-addon">
                                                <a href="javascript:void (0)" @click.prevent="copyText"><i class="ti-layers"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="col-md-12">Title</label>
                                    <div class="col-md-12">
                                        <input class="form-control input-sm" id="title"
                                               v-model="mediaLibraryDetails.title"
                                               @change.prevent="editMediaLibraryDetail(mediaLibraryDetails.id)"
                                               :value="mediaLibraryDetails.title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="caption" class="col-md-12">Caption</label>
                                    <div class="col-md-12">
                                            <textarea name="caption" id="caption" cols="10" rows="5"
                                                      v-model="mediaLibraryDetails.caption"
                                                      @change.prevent="editMediaLibraryDetail(mediaLibraryDetails.id)"
                                                      class="form-control input-sm">
                                                @{{ mediaLibraryDetails.caption }}
                                            </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alt_text" class="col-md-12">Alt Text</label>
                                    <div class="col-md-12">
                                        <input class="form-control input-sm" id="alt_text"
                                               v-model="mediaLibraryDetails.alt_text"
                                               @change.prevent="editMediaLibraryDetail(mediaLibraryDetails.id)"
                                               :value="mediaLibraryDetails.alt_text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-md-12">Description</label>
                                    <div class="col-md-12">
                                            <textarea name="description" id="description" cols="10" rows="5"
                                                      v-model="mediaLibraryDetails.description"
                                                      class="form-control input-sm"
                                                      @change.prevent="editMediaLibraryDetail(mediaLibraryDetails.id)">
                                                @{{ mediaLibraryDetails.description }}
                                            </textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="upload-files">
                        <div class="col-md-12">
                            <h3 class="box-title m-b-0">Upload Media Files </h3>
                            <p class="text-muted m-b-30"> Drop files anywhere to upload</p>
                            {!! Form::open([ 'route' => [ 'admin.media-library.store' ], 'files' => true, 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                            {!! Form::close() !!}
                            <p class="m-t-20">Maximum upload file size: 100 MB.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="close">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger waves-effect waves-light" id="insert-media" disabled>
                    Insert Media
                </button>
            </div>
        </div>
    </div>
</div>