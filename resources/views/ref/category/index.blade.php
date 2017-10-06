@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">{!! __('app.table.category') !!}</h3>
            <p class="text-muted m-b-30">Easy to managing your category</p>
            @include('ref.category.table')
        </div>
    </div>
@stop


@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                categoryUpdate: {
                    status: '',
                    id: ''
                },
                categories: {!! json_encode($categories->toArray()) !!}
            },
            created: function () {

            },
            methods: {
                updateStatus: function ($id) {
                    let vm = this;
                    let input = vm.categoryUpdate;
                    vm.$http.patch('/admin/ref/category/status/' + $id, input)
                        .then(response => {
                            console.log(response.data);
                        })
                }
            },
            watch: {}
        });

    </script>
@stop