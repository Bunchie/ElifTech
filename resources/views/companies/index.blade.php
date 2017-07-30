@extends('..layout.index')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <marquee behavior="alternate" scrollamount="20" direction=""><h1>ADD COMPANY</h1></marquee>
            </div>
            <div class="panel-body">
                <form method="POST" action="companies">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="company_name">Company name</label>
                        <input type="text" class="form-control shadow" name="company_name" id="company_name"/>
                    </div>
                    <div class="form-group">
                        <label for="estimated_company_revenues">Estimated company revenues</label>
                        <input type="text" class="form-control shadow" name="estimated_company_revenues"
                               id="estimated_company_revenues"/>
                    </div>
                    <div class="form-group">
                        <label for="companies">Father Company</label>
                        <select id="companies" name="parent_id" class="form-control shadow">
                            <option value=""></option>
                            @foreach ($companies as $company)
                                <option value={{$company['id']}}>{{$company['company_name']}}</option>
                                @if (count($company['children_recursive']) > 0)
                                    @foreach($company['children_recursive'] as $company)
                                        <option value={{$company['id']}}>{{$company['company_name']}}</option>
                                        @include('companies.option_companies_children', $company)
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-lg btn-block" value="ADD"/>
                    </div>
                </form>
            </div>
        </div>
        @if (count($companies) > 0)
            <ul class="list-group blue-section">
                @foreach ($companies as $company)
                    @include('companies.table_companies_view', $company)
                    @if (count($company['children_recursive']) > 0)
                        <li class="list-group-item yellow-section">
                            <ul class="list-group blue-section">
                                @foreach($company['children_recursive'] as $company)
                                    @include('companies.companies_children', $company)
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <div class="center yellow-section">
                <h2>You have no companies!</h2>
            </div>
        @endif
    </div>
@endsection