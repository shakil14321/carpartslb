<!DOCTYPE html>
<html>

<head>
    <title>Car Parts Search</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <div class="header-search" style="position:relative;">
        <form action="{{ route('search.page') }}" method="GET">
            <input type="text" id="globalSearch" name="query" placeholder="Search products..." autocomplete="off"
                class="form-control" value="{{ request()->query('query') }}">
            <button type="submit">Search</button>
        </form>
        <div id="searchResults" class="search-results" style="display:none;"></div>
    </div>

    <div>
        @yield('content')
    </div>

    @yield('scripts')
</body>

</html>
