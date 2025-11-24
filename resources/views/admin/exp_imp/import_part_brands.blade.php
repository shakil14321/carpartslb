@extends('layouts.admin.admin-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-cloud-upload"></i>
                <h3 class="box-title">Import Parts Brands</h3>

                @if(session('failures'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Import Errors:</strong>
                    <ul>
                        @foreach (session('failures') as $failure)
                        <li>Row {{ $failure->row() }}: {{ implode(', ', $failure->errors()) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success" style="margin:20px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div class="box-body pad table-responsive">
                <p>Click here to export excel sheet template</p>
                <div >
                    <a href="{{ route('partBrand.export') }}" class="btn btn-primary">Excel Sheet Template</a>
                </div>
            </div>
            <div class="box-body pad table-responsive">
                <p>Click here to import the car parts brands by excel sheet</p>
                <div>
                    <form action="{{ route('partBrand.import') }}" method="POST" enctype="multipart/form-data"
                        style="display:inline-block;">
                        @csrf
                        <div class="form-group">
                            <label for="excelFile">Import Excel File</label>
                            <input type="file" name="file" id="excelFile" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import Excel</button>
                    </form>
                </div>
            </div><!-- /.box -->
        </div>
    </div><!-- /.col -->
</div><!-- ./row -->
@endsection
