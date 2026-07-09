@if(!isset($hideSearch) || !$hideSearch)
    <form method="GET" action="{{ url()->current() }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="{{ $searchPlaceholder ?? 'Buscar...' }}" value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ url()->current() }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
            @endif
        </div>
    </form>
@endif
