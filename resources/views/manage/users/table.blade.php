<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/16/2017
 * Time: 10:12 PM
 */
?>
<table data-toggle="table" data-height="350" data-mobile-responsive="true" class="table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Joined</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($users))
        @foreach($users as $user)
            <tr id="tr-id-{!! $user->id !!}" class="tr-class-{!! $user->id !!}">
                <td>{!! $user->id !!}</td>
                <td id="td-id-{!! $user->id !!}" class="td-class-{!! $user->id !!}">
                    {!! $user->name !!}
                </td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->created_at !!}</td>
                <td>
                    <div class="btn-group">
                        <a href="{!! route('admin.manage.user.show', [$user->id]) !!}"
                           class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                            View
                        </a>
                        <a href="{!! route('admin.manage.user.edit', [$user->id]) !!}"
                           class='btn btn-primary btn-outline waves-effect btn-xs'>
                            Edit
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td>
                <p>There is no user data! Please add user</p>
            </td>
        </tr>
    @endif
    </tbody>
</table>