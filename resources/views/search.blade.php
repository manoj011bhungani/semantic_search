<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Semantic Search</title>
</head>
<body>
    <h1>Semantic Category Search</h1>

    <form method="POST" action="{{ route('search.perform') }}">
        @csrf
        <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="Search for a category" required>
        <button type="submit">Search</button>
    </form>

    @if(isset($results) && count($results))
        <h3>Results:</h3>
        <ul>
            @foreach($results as $result)
                <li>{{ $result['name'] }} (Score: {{ number_format($result['score'], 4) }})</li>
            @endforeach
        </ul>
    @elseif(isset($query))
        <p>No results found for "{{ $query }}".</p>
    @endif
</body>
</html>
