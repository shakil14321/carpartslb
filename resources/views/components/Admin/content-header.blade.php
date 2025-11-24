<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">
        @php
          $firstSeg = request()->segment(2); 
          $secondSeg = request()->segment(3); 
          echo ucwords($firstSeg . " " . $secondSeg ?? '');
        @endphp
      </li>
    </ol>
  </section>