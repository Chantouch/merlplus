<div class="body table-responsive">
    @if(count($roles))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <th scope="row">{!! $role->id !!}</th>
                    <td>{!! $role->name !!}</td>
                    <td>{!! $role->display_name !!}</td>
                    <td>{!! $role->description !!}</td>
                    <td>{!! $role->created_at !!}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{!! route('admin.manage.role.show', [$role->id]) !!}"
                               class='btn btn-info btn-outline btn-1b waves-effect btn-xs'>
                                View
                            </a>
                            <a href="{!! route('admin.manage.role.edit', [$role->id]) !!}"
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