@extends('layouts.admin.admin-layout')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success" style="margin:20px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-xs-12">
                <div class="box">
                    <div class="main-flex">
                        <h3 class="box-title">Cache Clear Setting</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-6 col-md-3 mb-2">

                                <button type="submit" class="btn  btn-block btn-warning w-100" id="route_cache_clear">
                                    Route Cache Clear
                                </button>


                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <button class="btn btn-block btn-primary w-100" id="view_cache_clear">View Cache
                                    Clear</button>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <button class="btn btn-block btn-success w-100" id="config_cache_clear">Config Cache
                                    Clear</button>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <button class="btn btn-block btn-danger w-100" id="simple_cache_clear">Simple Cache
                                    Clear</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 col-md-3" style="margin:20px 0 20px 0">
                                <button class="btn btn-block btn-success w-100" id="all_cache_clear">All Cache
                                    Clear</button>
                            </div>
                            
                        </div>
                        <script>
                            // Reusable function for cache clear buttons
                            function clearCache(routeUrl) {
                                fetch(routeUrl, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        alert(data.message);
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Something went wrong!');
                                    });
                            }

                            document.getElementById('route_cache_clear').addEventListener('click', function(e) {
                                e.preventDefault();
                                clearCache("{{ route('route.cache') }}");
                            });

                            document.getElementById('view_cache_clear').addEventListener('click', function(e) {
                                e.preventDefault();
                                clearCache("{{ route('view.cache') }}");
                            });

                            document.getElementById('config_cache_clear').addEventListener('click', function(e) {
                                e.preventDefault();
                                clearCache("{{ route('config.cache') }}");
                            });

                            document.getElementById('simple_cache_clear').addEventListener('click', function(e) {
                                e.preventDefault();
                                clearCache("{{ route('simple.cache') }}");
                            });

                            document.getElementById('all_cache_clear').addEventListener('click', function(e) {
                                e.preventDefault();
                                clearCache("{{ route('all.cache') }}");
                            });
                        </script>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
@endsection
