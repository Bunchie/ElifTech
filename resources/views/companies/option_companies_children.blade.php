@if (count($company['children_recursive']) > 0)
    @foreach($company['children_recursive'] as $company)
        <option value={{$company['id']}}>{{$company['company_name']}}</option>
        @include('companies.option_companies_children', $company)
    @endforeach
@endif