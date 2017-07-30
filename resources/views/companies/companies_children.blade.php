<li class="list-group-item yellow-section">
    @include('companies.table_companies_view', $company)
    @if (count($company['children_recursive']) > 0)
        <ul class="list-group blue-section">
            @foreach($company['children_recursive'] as $company)
                @include('companies.companies_children', $company)
            @endforeach
        </ul>
    @endif
</li>