<?php

namespace App\Models;

class CalculationOfRevenue
{
    protected $companiesArray;

    /**
     * CalculationOfRevenue constructor.
     * @param $companies
     */
    public function __construct($companies)
    {
        $this->companiesArray = $companies;
    }

    /**
     * @param $companies
     */
    private function modifyRevenueArray(&$companies)
    {
        foreach ($companies as &$company) {

            $company['total_revenues'] = floatval($company['estimated_company_revenues']);

            if (count($company['children_recursive']) !== 0) {

                foreach ($company['children_recursive'] as &$childCompany) {

                    $company['total_revenues'] += floatval($childCompany['estimated_company_revenues']);

                    $this->modifyRevenueArray($company['children_recursive']);

                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getCalculatedRevenueArray()
    {
        $this->modifyRevenueArray($this->companiesArray);

        return $this->companiesArray;
    }
}