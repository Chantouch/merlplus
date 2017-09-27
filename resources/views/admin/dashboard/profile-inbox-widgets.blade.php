<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 9/2/2017
 * Time: 3:55 PM
 */
?>
<div class="row">
    <div class="col-md-6 col-sm-12 col-lg-4">
        <div class="panel">
            <div class="p-30">
                <div class="row">
                    <div class="col-xs-4 col-sm-4">
                        @if(isset($profile))
                            @if($profile->hasThumbnail())
                                <img src="{!! asset('storage/uploads/user/'.$profile->thumbnail()->filename) !!}"
                                     alt="{!! $profile->name !!}" class="img-circle img-responsive">
                            @endif
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <h2 class="m-b-0">{!! $profile->name !!}</h2>
                        @if($profile->isAdmin())
                            <h4>{!! ucfirst($profile->roles->first()->name) !!}</h4>
                        @endif
                        <a href="{!! route('admin.profile.edit') !!}" class="btn btn-rounded btn-success">
                            <i class="ti-pencil m-r-5"></i> EDIT
                        </a>
                    </div>
                </div>
                <div class="row text-center m-t-30">
                    <div class="col-xs-4 b-r">
                        <h2>{!! $profile->posts->count() !!}</h2>
                        <h4>POSTS</h4>
                    </div>
                    <div class="col-xs-4 b-r">
                        <h2>{!! $profile->mediasLibrary->count() !!}</h2>
                        <h4>MEDIA</h4>
                    </div>
                    <div class="col-xs-4">
                        <h2>{!! $profile->comments->count() !!}</h2>
                        <h4>COMMENTS</h4>
                    </div>
                </div>
            </div>
            <hr class="m-t-10"/>
            <div class="p-20 text-center">
                <p class="qoute">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                    incididunt ut labore
                </p>
                <hr>
            </div>
            <ul class="dp-table profile-social-icons">
                <li><a href="javascript:void(0)"><i class="fa fa-globe"></i></a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-youtube"></i></a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 col-lg-8 col-sm-12">
        <div class="panel">
            <div class="panel-heading">MANAGE USERS</div>
            <div class="table-responsive">
                <table class="table table-hover manage-u-table">
                    <thead>
                    <tr>
                        <th style="width: 70px;" class="text-center">#</th>
                        <th>NAME</th>
                        <th>OCCUPATION</th>
                        <th>EMAIL</th>
                        <th>JOINED@</th>
                        <th>MANAGE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user,index) in dashboard.usersList">
                        <td class="text-center">@{{ index + 1 }}</td>
                        <td>
                            <span class="font-medium" v-text="user.name"></span>
                            <br/><span class="text-muted">Texas, Unitedd states</span>
                        </td>
                        <td>
                            <span v-for="role in user.roles" v-text="role.display_name"></span>
                            <br/><span class="text-muted">Past : teacher</span>
                        </td>
                        <td>
                            @{{ user.email }}
                            <br/><span class="text-muted">999 - 444 - 555</span>
                        </td>
                        <td>
                            @{{ user.created_at }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-outline btn-circle btn-lg m-r-5"
                                    v-if="user.id != auth.dashboard_value" @click.prevent="deleteUser(user)">
                                <i class="icon-trash"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"
                                    @click.prevent="editUser(user)">
                                <i class="ti-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" value="{!! auth()->id() !!}" name="dashboard_value" id="dashboard_value">
        <!-- /.modal -->
        <div id="edit-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Edit User</h4></div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name" class="control-label">Name:</label>
                                <input class="form-control" id="name" v-model="updateUser.name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email:</label>
                                <input type="email" class="form-control" id="email" v-model="updateUser.email">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"
                                @click.prevent="updateUserInfo(updateUser.id)">Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
