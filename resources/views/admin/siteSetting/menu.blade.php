@extends('layouts.admin.admin-layout')

@section('content')
<section class="content container-fluid">
    <h2>Site Settings</h2>

    <!-- Alert messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('site.setting.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Dynamic Menu Items -->
        <div id="menu-container">
            <label>Menu Items</label>
            @if(!empty($setting->menu_items))
                @foreach($setting->menu_items as $index => $item)
                    <div class="row menu-item mb-2">
                        <div class="col-md-5">
                            <input type="text" name="menu_name[]" class="form-control" value="{{ $item['name'] }}" placeholder="Menu Name">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="menu_link[]" class="form-control" value="{{ $item['link'] }}" placeholder="Menu Link">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-menu">X</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <button type="button" class="btn btn-primary" id="add-menu">+ Add Menu Item</button><br><br>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>

<script>
document.getElementById('add-menu').addEventListener('click', function() {
    const div = document.createElement('div');
    div.classList.add('menu-item', 'row', 'mb-2');
    div.innerHTML = `
        <div class="col-md-5">
            <input type="text" name="menu_name[]" class="form-control" placeholder="Menu Name">
        </div>
        <div class="col-md-5">
            <input type="text" name="menu_link[]" class="form-control" placeholder="Menu Link">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-menu">X</button>
        </div>
    `;
    document.getElementById('menu-container').appendChild(div);
});

document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-menu')){
        e.target.closest('.menu-item').remove();
    }
});
</script>
@endsection
