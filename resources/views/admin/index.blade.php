<x-admin.admin-master>
    @if (auth()->user()->userHasRole('Admin'))
    @section('title')
        <h1 class="h3 mb-4 text-gray-800">Шаблонная страница</h1>
    @show()
    @endif
</x-admin.admin-master>