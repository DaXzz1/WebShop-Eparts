<div class="relative w-1/2 shrink">
    <div class="gap-2 flex w-full">
        <input type="text" id="search" name="search"
               class="input input-primary input-sm w-full"
               placeholder="{{ __('header.input.placeholder', ['count' => \App\Models\Part::all()->count()]) }}">
        <a id="submit" href="{{ route('search.index') }}" class="btn btn-sm btn-primary">{{ __('header.input.button') }}</a>
    </div>

    <div class="absolute z-[2] bg-white rounded mt-5 py-2 w-full top-full left-0 hidden flex-col shadow-xl"
         id="searchResults">
    </div>

    <script>
        let timeout = null;

        const searchInput = document.getElementById('search');
        const searchResults = document.getElementById('searchResults');

        const handleSearch = () => {
            fetch(`/api/search?query=${searchInput.value}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    "X-localization": "{{ app()->getLocale() }}",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then(response => response.text())
                .then(data => {
                    searchResults.classList.remove('hidden')
                    searchResults.classList.add('flex')
                    searchResults.innerHTML = data
                });
        }

        const handleSearchDebounced = () => {
            clearTimeout(timeout);
            timeout = setTimeout(handleSearch, 500);
        }

        searchInput.addEventListener('input', () => {
            if (searchInput.value.length === 0) {
                searchResults.classList.add('hidden');
                searchResults.classList.remove('flex');
                searchResults.innerHTML = '';
                return;
            }

            handleSearchDebounced()
        });

        document.addEventListener('click', (event) => {
            if (searchResults.children.length === 0) return;

            if (event.target === searchInput) {
                searchResults.classList.remove('hidden')
                searchResults.classList.add('flex')
                return;
            }

            searchResults.classList.add('hidden')
        });
    </script>
</div>
