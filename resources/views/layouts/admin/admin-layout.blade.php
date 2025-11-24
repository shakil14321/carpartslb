<!DOCTYPE html>
<html lang="en">

<head>
    <x-Admin.head />
</head>

<body class="skin-blue">
    <!-- Start Main Page Wrapper -->
    <div class="wrapper">
        <x-Admin.header />
        <x-Admin.sidebar />

        <!-- Right side column. Start Content Wrapper -->
        <div class="content-wrapper">
            <x-Admin.content-header />

            @yield('content')

        </div>
        <!-- End Content Wrapper -->


        <x-Admin.footer />
    </div>
    <!-- End Main Page Wrapper -->
<x-Admin.script />
</body>

</html>