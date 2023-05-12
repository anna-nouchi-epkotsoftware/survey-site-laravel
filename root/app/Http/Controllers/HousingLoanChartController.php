<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHousingLoanChartRequest;
use App\Http\Requests\UpdateHousingLoanChartRequest;
use App\Models\HousingLoanChart;

class HousingLoanChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //住宅ローン利用状況データ取得
        $usageSituationData = HousingLoanChart::select('usage_situation')
            ->selectRaw('COUNT(usage_situation) as count')
            ->groupBy('usage_situation')
            ->get();
        //chart.js用にデータの配列作成
        $numberOfPeopleList = [];
        $usageSituationTitleList = [];
        foreach ($usageSituationData as $usageSituation) {
            $numberOfPeopleList[] = $usageSituation->count;
            $usageSituationTitleList[] = $usageSituation->usage_situation;
        }
        $total = array_sum($numberOfPeopleList);
        $AggregateResultsOfUsage = [];
        foreach ($numberOfPeopleList as $value) {
            $AggregateResultsOfUsage[] = round(($value / $total) * 100,1);
        }
        //住宅ローンの借入先のデータ取得
        $financialInstitution = HousingLoanChart::select('financial_institution')
            ->selectRaw('COUNT(financial_institution) as count')
            ->groupBy('financial_institution')
            ->where('financial_institution', '=', '住宅金融公庫')
            ->get();
            foreach($financialInstitution as $financialInstitutionData){
                $financialInstitutionCount=$financialInstitutionData->count;
                $financialInstitutionTitle=$financialInstitutionData->financial_institution;
            }
        $financialInstitution2 = HousingLoanChart::select('financial_institution2')
            ->selectRaw('COUNT(financial_institution2) as count')
            ->groupBy('financial_institution2')
            ->where('financial_institution2', '=', '地方銀行')
            ->get();
            foreach($financialInstitution2 as $financialInstitution2Data){
                $financialInstitution2Count=$financialInstitution2Data->count;
                $financialInstitution2Title=$financialInstitution2Data->financial_institution2;
            }
        $financialInstitution3 = HousingLoanChart::select('financial_institution3')
            ->selectRaw('COUNT(financial_institution3) as count')
            ->groupBy('financial_institution3')
            ->where('financial_institution3', '=', 'みずほ銀行')
            ->get();
            foreach($financialInstitution3 as $financialInstitution3Data){
                $financialInstitution3Count=$financialInstitution3Data->count;
                $financialInstitution3Title=$financialInstitution3Data->financial_institution3;
            }
        $financialInstitution4 = HousingLoanChart::select('financial_institution4')
            ->selectRaw('COUNT(financial_institution4) as count')
            ->groupBy('financial_institution4')
            ->where('financial_institution4', '=', 'その他')
            ->get();
            foreach($financialInstitution4 as $financialInstitution4Data){
                $financialInstitution4Count=$financialInstitution4Data->count;
                $financialInstitution4Title=$financialInstitution4Data->financial_institution4;
            }
        $financialInstitutionTotal=array_sum([$financialInstitutionCount,$financialInstitution2Count,$financialInstitution3Count,$financialInstitution4Count]);
        $financialInstitutionRatio= round(($financialInstitutionCount/$financialInstitutionTotal)*100,1);
        $financialInstitution2Ratio= round(($financialInstitution2Count/$financialInstitutionTotal)*100,1);
        $financialInstitution3Ratio= round(($financialInstitution3Count/$financialInstitutionTotal)*100,1);
        $financialInstitution4Ratio= round(($financialInstitution4Count/$financialInstitutionTotal)*100,1);
        $financialInstitutionList=[$financialInstitutionRatio,$financialInstitution2Ratio,$financialInstitution3Ratio,$financialInstitution4Ratio];

        return view('survey.index', [
            'AggregateResultsOfUsage' => $AggregateResultsOfUsage,
            'usageSituationTitleList' => $usageSituationTitleList,
            'financialInstitutionList' => $financialInstitutionList,
        ]);
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
     * @param  \App\Http\Requests\StoreHousingLoanChartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHousingLoanChartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HousingLoanChart  $housingLoanChart
     * @return \Illuminate\Http\Response
     */
    public function show(HousingLoanChart $housingLoanChart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HousingLoanChart  $housingLoanChart
     * @return \Illuminate\Http\Response
     */
    public function edit(HousingLoanChart $housingLoanChart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHousingLoanChartRequest  $request
     * @param  \App\Models\HousingLoanChart  $housingLoanChart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHousingLoanChartRequest $request, HousingLoanChart $housingLoanChart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HousingLoanChart  $housingLoanChart
     * @return \Illuminate\Http\Response
     */
    public function destroy(HousingLoanChart $housingLoanChart)
    {
        //
    }
}
