<div class="body table-responsive">
    @if(count($settings))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>{!! __('admin.name') !!}</th>
                <th>{!! __('admin.value') !!}</th>
                <th>{!! __('admin.description') !!}</th>
                <th>{!! __('admin.action') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($settings as $index => $setting)
                <tr>
                    <th>{!! $loop->index+1 !!}</th>
                    <td>{!! $setting->name !!}</td>
                    <td>
						<?php
						$json = json_decode($setting->field, true);
						?>
                        @if($json['type'] == 'checkbox')
                            <a href="javascript:void (0)" class="ajax-request" data-table="settings" data-field="value"
                               data-line-id="value{!! $setting->id !!}"
                               data-id="{!! $setting->id !!}" data-value="{!! $setting->value !!}">
                                <i id="value{!! $setting->id !!}"
                                   class="fa {!! $setting->value == 1 ? 'fa-check-square-o' : 'fa-square-o' !!}"
                                   aria-hidden="true"></i>
                            </a>
                        @elseif($json['type'] == 'image')
                            <img src="{!! asset($setting->value) !!}" alt="{!! $setting->value !!}">
                        @else
                            {!! $setting->value !!}
                        @endif
                    </td>
                    <td>{!! $setting->description !!}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{!! route('admin.settings.edit', [$setting->id]) !!}"
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