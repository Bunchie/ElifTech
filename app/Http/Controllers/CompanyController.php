<?php

namespace App\Http\Controllers;

use Validator, Input, Redirect;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CalculationOfRevenue;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $companies = new CalculationOfRevenue(
            $company->with('childrenRecursive')->whereNull('parent_id')->get()->toArray()
        );

        return view('companies.index', ['companies' => $companies->getCalculatedRevenueArray()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        Validator::make($request->all(), [
            'company_name' => 'required|unique:companies,company_name|max:255',
            'estimated_company_revenues' => 'required|regex:/^\d*(\.\d{2})?$/',
        ])->validate();

        $company->create($request->all())->save();

        return redirect('companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request['parent_id'] !== $id) {

            Company::find($id)->update($request->all());

            return redirect('companies');
        }

        return redirect('companies');
    }


    /**
     * @param Company $company
     * @param $id
     */
    public function destroy($id)
    {
        Company::where('parent_id', $id)->update(['parent_id' => null]);

        Company::destroy($id);

        return redirect('companies');
    }
}
