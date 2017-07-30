<div style="overflow-y:auto; width:100%">
    <table class="table table-bordered" style="background-color: white; margin-bottom: inherit">
        <thead>
        <tr>
            <th class="center">Name Company</th>
            <th class="center">Estimated Company Revenues</th>
            <th class="center">Total</th>
            <th class="center">Update</th>
            <th class="center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="center">{{$company['company_name']}}</td>
            <td class="center">{{$company['estimated_company_revenues']}}</td>
            <td class="center">{{$company['total_revenues']}}</td>
            <td class="center">
                <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal"
                        data-target="#myModal-{{$company['id']}}">Update
                </button>
                <div class="modal fade" id="myModal-{{$company['id']}}" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><h3>Updating company "{{$company['company_name']}}"</h3></h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="companies/{{$company['id']}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                        <label for="company_name">Company name</label>
                                        <input type="text" class="form-control shadow" name="company_name"
                                               id="company_name"
                                               value={{$company['company_name']}} />
                                    </div>
                                    <div class="form-group">
                                        <label for="estimated_company_revenues">Estimated company revenues</label>
                                        <input type="text" class="form-control shadow" name="estimated_company_revenues"
                                               id="estimated_company_revenues"
                                               value={{$company['estimated_company_revenues']}} />
                                    </div>
                                    <div class="form-group">
                                        <label for="companies">Father Company</label>
                                        <select id="companies" name="parent_id" class="form-control shadow"
                                        >
                                            <option value={{$company['parent_id']}}>{{$company['parent_id']}}</option>
                                            <option value=""></option>
                                            @foreach ($companies as $companyValue)
                                                <option value={{$company['id']}}>{{$company['company_name']}}</option>
                                                @if (count($companyValue['children_recursive']) > 0)
                                                    @foreach($companyValue['children_recursive'] as $companyValueTwo)
                                                        <option value={{$companyValueTwo['id']}}>{{$companyValueTwo['company_name']}}</option>
                                                        @include('companies.option_companies_children', $companyValueTwo)
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success btn-lg btn-block"
                                               value="UPDATE COMPANY"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="center">
                <div id="delete-{{$company['id']}}">
                    <form method="POST" action="companies/{{$company['id']}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger btn-lg btn-block" type="submit" value="Delete">
                    </form>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
