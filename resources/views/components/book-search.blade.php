@props(['q' => ''])

<form method="GET" action="{{ route('books.search') }}" class="mb-6 flex items-center gap-2">
    <input
        type="text"
        name="q"
        value="{{ old('q', $q) }}"
        placeholder="Search books…"
        class="w-full sm:w-80 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
    />
    <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md">
        Search
    </button>

    @if($q !== '')
        <a href="{{ route('books.index') }}" class="text-sm underline text-gray-600 hover:text-gray-800">
            Clear
        </a>
    @endif
</form>