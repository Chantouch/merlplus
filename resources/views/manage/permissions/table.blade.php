<div class="body table-responsive">
    @if(count($permissions))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <th scope="row">{!! $permission->id !!}</th>
                    <td>{!! $permission->name !!}</td>
                    <td>{!! $permission->display_name !!}</td>
                    <td>{!! $permission->created_at !!}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{!! route('admin.manage.permission.show', [$permission->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                View
                            </a>
                            <a href="{!! route('admin.manage.permission.edit', [$permission->id]) !!}"
                               class='btn btn-primary btn-outline waves-effect btn-xs'>
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>There is no data here.</p>
    @endif
</div>