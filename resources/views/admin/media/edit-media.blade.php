<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/28/2017
 * Time: 1:17 PM
 */
?>
<div id="edit-media" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">{!! __('admin.media_library') !!}</h4></div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <div class="col-md-9 col-sm-9">
                    <h4 class="box-title m-b-0">{!! __('admin.media_library_uploaded') !!}</h4>
                    <p class="text-muted m-b-10"> Select any file to keep to article</p>
                    <div class="row">
                        <div class="thumbnail thumbnail-image">
                            <img class="details-image" :src="mediaLibraryDetails.url" draggable="false" :alt="mediaLibraryDetails.alt_text">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h4 class="box-title m-b-0">{!! __('admin.media_details') !!}</h4>
                    <p class="text-muted m-b-10">{!! __('admin.media_deep_details_insider') !!}</p>
                    <div class="attachment-info">
                        <div class="details">
                            <div class="filename">File name: @{{ mediaLibraryDetails.limit_name + '.' +
                                mediaLibraryDetails.mime_type }}
                            </div>
                            <div class="mime_typ">File type: @{{ mediaLibraryDetails.mime_type }}</div>
                            <div class="uploaded">Uploaded on: @{{ mediaLibraryDetails.uploaded_at }}</div>
                            <div class="file-size">364 kB</div>
                            <div class="dimensions">1200 × 799</div>
                        </div>
                    </div>
                    <form action="#" class="form-horizontal">
                        <div class="form-group">
                            <label for="url" class="col-md-12">URL</label>
                            <div class="col-md-12">
                                <input class="form-control input-sm" id="url" readonly
                                       :value="mediaLibraryDetails.url" ref="url">
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
                                          v-model="mediaLibraryDetails.description" class="form-control input-sm"
                                          @change.prevent="editMediaLibraryDetail(mediaLibraryDetails.id)">
                                    @{{ mediaLibraryDetails.description }}
                                </textarea>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <button type="button" class="btn btn-danger waves-effect"
                            @click="deleteMediaLibrary(mediaLibraryDetails.id)">
                        Delete Permanently
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="close">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger waves-effect waves-light" id="insert-media">
                    Edit Image
                </button>
            </div>
        </div>
    </div>
</div>