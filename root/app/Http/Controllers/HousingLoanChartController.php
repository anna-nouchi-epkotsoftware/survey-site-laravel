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
            $AggregateResultsOfUsage[] = round(($value / $total) * 100, 1);
        }
        //住宅ローンの借入先のデータ取得
        $financialInstitution = HousingLoanChart::select('financial_institution')
            ->selectRaw('COUNT(financial_institution) as count')
            ->groupBy('financial_institution')
            ->where('financial_institution', '=', '住宅金融公庫')
            ->get();
        foreach ($financialInstitution as $financialInstitutionData) {
            $financialInstitutionCount = $financialInstitutionData->count;
            $financialInstitutionTitle = $financialInstitutionData->financial_institution;
        }
        $financialInstitution2 = HousingLoanChart::select('financial_institution2')
            ->selectRaw('COUNT(financial_institution2) as count')
            ->groupBy('financial_institution2')
            ->where('financial_institution2', '=', '地方銀行')
            ->get();
        foreach ($financialInstitution2 as $financialInstitution2Data) {
            $financialInstitution2Count = $financialInstitution2Data->count;
            $financialInstitution2Title = $financialInstitution2Data->financial_institution2;
        }
        $financialInstitution3 = HousingLoanChart::select('financial_institution3')
            ->selectRaw('COUNT(financial_institution3) as count')
            ->groupBy('financial_institution3')
            ->where('financial_institution3', '=', 'みずほ銀行')
            ->get();
        foreach ($financialInstitution3 as $financialInstitution3Data) {
            $financialInstitution3Count = $financialInstitution3Data->count;
            $financialInstitution3Title = $financialInstitution3Data->financial_institution3;
        }
        $financialInstitution4 = HousingLoanChart::select('financial_institution4')
            ->selectRaw('COUNT(financial_institution4) as count')
            ->groupBy('financial_institution4')
            ->where('financial_institution4', '=', 'その他')
            ->get();
        foreach ($financialInstitution4 as $financialInstitution4Data) {
            $financialInstitution4Count = $financialInstitution4Data->count;
            $financialInstitution4Title = $financialInstitution4Data->financial_institution4;
        }
        $financialInstitutionTotal = array_sum([$financialInstitutionCount, $financialInstitution2Count, $financialInstitution3Count, $financialInstitution4Count]);
        $financialInstitutionRatio = round(($financialInstitutionCount / $financialInstitutionTotal) * 100, 1);
        $financialInstitution2Ratio = round(($financialInstitution2Count / $financialInstitutionTotal) * 100, 1);
        $financialInstitution3Ratio = round(($financialInstitution3Count / $financialInstitutionTotal) * 100, 1);
        $financialInstitution4Ratio = round(($financialInstitution4Count / $financialInstitutionTotal) * 100, 1);
        $financialInstitutionList = [$financialInstitutionRatio, $financialInstitution2Ratio, $financialInstitution3Ratio, $financialInstitution4Ratio];

        return view('survey.index', [
            'AggregateResultsOfUsage' => $AggregateResultsOfUsage,
            'usageSituationTitleList' => $usageSituationTitleList,
            'financialInstitutionList' => $financialInstitutionList,
        ]);
    }

    public function questionPageIndex()
    {
        //質問TOPページ表示
        return view('survey.question-page.index');
    }

    public function showPage1()
    {
        //page1表示
        return view('survey.question-page.page1');
    }
    public function postPage1(StoreHousingLoanChartRequest $request)
    {
        //page1のformに入力された値をセッションに保存
        $request->session()->put('form.page1', $request->usage_situation);
        return redirect()->route('housing-loan.question-page.page2.showPage2');
    }

    public function showPage2(StoreHousingLoanChartRequest $request)
    {
        //page2表示
        if (!$request->session()->has('form.page1')) {
            return redirect()->route('housing-loan.question-page.page1.showPage1')->with('message', 'どれかお選びください。');
        } elseif ($request->session()->get('form.page1') === '借りたことがない') {
            return view('survey.question-page.page3');
        }    else {
            return view('survey.question-page.page2');
        }
    }
    public function postPage2(StoreHousingLoanChartRequest $request)
    {
        //page2のformに入力された値をセッションに保存
        $request->session()->put('form.page2', $request->all());
        return redirect()->route('housing-loan.question-page.page3.showPage3');
    }
    public function showPage3(StoreHousingLoanChartRequest $request)
    {
        //page3表示
        if($request->session()->get('form.page2')['financial_institution'] ?? ''){
            return view('survey.question-page.page3');
        }elseif($request->session()->get('form.page2')['financial_institution2'] ?? ''){
            return view('survey.question-page.page3');
        }elseif($request->session()->get('form.page2')['financial_institution3'] ?? ''){
            return view('survey.question-page.page3');
        }elseif($request->session()->get('form.page2')['financial_institution4'] ?? ''){
            return view('survey.question-page.page3');
        }else{
            return redirect()->route('housing-loan.question-page.page2.showPage2')->with('message', 'どれかお選びください。');
        }
    }
    public function submitForm(StoreHousingLoanChartRequest $request)
    {
        //DBに保存
        $formPage2 = $request->session()->get('form.page2');
        $usage_situation = $request->session()->get('form.page1');
        HousingLoanChart::create([
            'name' => $request->name,
            'usage_situation' => $usage_situation,
            'financial_institution' => $formPage2['financial_institution'] ?? '',
            'financial_institution2' => $formPage2['financial_institution2'] ?? '',
            'financial_institution3' => $formPage2['financial_institution3'] ?? '',
            'financial_institution4' => $formPage2['financial_institution4'] ?? '',
        ]);
        $request->session()->forget('form');
        return redirect()->route('housing-loan.question-page.last.showLast');
    }
    public function showLast()
    {
        return view('survey.question-page.last');
    }
}
