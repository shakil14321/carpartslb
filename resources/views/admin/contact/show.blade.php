@extends('layouts.admin.admin-layout')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
                <a href="{{ url()->previous() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-move-left-icon lucide-move-left">
                        <path d="M6 8L2 12L6 16" />
                        <path d="M2 12H22" />
                    </svg>
                </a>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box" style="padding: 30px 20px !important;">
                    <div class="main-flex">
                        <h3 class="box-title" style="margin-left:-15px;border-bottom:1px solid #dfd3d3;padding-bottom:5px;">Order Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        @if ($contact)
                            <div class="container-fluid" style=""> 
                            
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="order_detail_heading">Contact Name</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <small>{{ ucwords(($contact->first_name ?? '') . ' ' . ($contact->last_name ?? '')) }}</small>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="order_detail_heading">Contact Email</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <small>{{ $contact->email ?? '' }}</small>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="order_detail_heading">Contact Phone Number</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <small>{{ $contact->phone ?? '' }}</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="order_detail_heading">Message</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <small>{{ $contact->message ?? '' }}</small>
                                    </div>
                                </div>
                                
                                <div class="row" style="margin-top:20px">
                                    <div class="col-3">
                                        <a href="{{ url()->previous() }}"
                                            class="btn btn-md btn-primary text-center">Back</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <small>Order not found.</small>
                        @endif
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

@endsection
