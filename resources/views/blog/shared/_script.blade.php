@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                latest_posts: [],
                most_read_posts: [],
                options: {
                    isLoading: false,
                    imgUrl: ''
                },
                endpoint: '/api/v2/'
            },
            created: function () {
                this.getLatestPost();
                this.getMostReadPost();
            },
            methods: {
                getLatestPost() {
                    let vm = this;
                    this.options.isLoading = true;
                    vm.$http.get(this.endpoint + 'latest').then(response => {
                        this.options.isLoading = false;
                        vm.latest_posts = response.data.data
                    })
                },
                getMostReadPost() {
                    let vm = this;
                    this.options.isLoading = true;
                    vm.$http.get(this.endpoint + 'most-read').then(response => {
                        this.options.isLoading = false;
                        vm.most_read_posts = response.data.data
                    })
                }
            }
        });
    </script>
@stop