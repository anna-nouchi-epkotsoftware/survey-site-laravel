<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $financialInstitutions = [
            'financial_institution' => '住宅金融公庫',
            'financial_institution2' => '地方銀行',
            'financial_institution3' => 'みずほ銀行',
            'financial_institution4' => 'その他'
        ];

        $financialInstitutionCounts = [];
        $financialInstitutionList = [];

        //DBからデータ取得
        foreach ($financialInstitutions as $key => $financialInstitution) {
            $financialInstitutionData = HousingLoanChart::select($key)
                ->selectRaw('COUNT(' . $key . ') as count')
                ->groupBy($key)
                ->where($key, '=', $financialInstitution)
                ->get()
                ->first();
            $financialInstitutionCounts[] = $financialInstitutionData['count'];
        }

        //集計結果の合計
        $financialInstitutionTotal = array_sum($financialInstitutionCounts);

        //chart.js用にデータの配列作成
        foreach ($financialInstitutionCounts as $financialInstitutionCount) {
            $financialInstitutionList[] = round(($financialInstitutionCount / $financialInstitutionTotal) * 100, 1);
        }

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
    public function postPage1(Request $request)
    {
        //page1のformに入力された値をセッションに保存
        $request->session()->put('form.page1', $request->usage_situation);
        return redirect()->route('housing-loan.question-page.page2.showPage2');
    }

    public function showPage2(Request $request)
    {
        //page2表示
        if (!$request->session()->has('form.page1')) {
            return redirect()->route('housing-loan.question-page.page1.showPage1')->with('message', 'どれかお選びください。');
        } elseif ($request->session()->get('form.page1') === '借りたことがない') {
            return view('survey.question-page.page3');
        } else {
            return view('survey.question-page.page2');
        }
    }
    public function postPage2(Request $request)
    {
        //page2のformに入力された値をセッションに保存
        $request->session()->put('form.page2', $request->all());
        return redirect()->route('housing-loan.question-page.page3.showPage3');
    }
    public function showPage3(Request $request)
    {
        //page3表示
        if (
            isset($request->session()->get('form.page2')['financial_institution']) || isset($request->session()->get('form.page2')['financial_institution2']) || isset($request->session()->get('form.page2')['financial_institution3']) || isset($request->session()->get('form.page2')['financial_institution4'])
        ) {
            return view('survey.question-page.page3');
        } else {
            return redirect()->route('housing-loan.question-page.page2.showPage2')->with('message', 'どれかお選びください。');
        }
    }
    public function submitForm(Request $request,StoreHousingLoanChartRequest $store_request)
    {
        //DBに保存
        $formPage2 = $request->session()->get('form.page2');
        $usage_situation = $request->session()->get('form.page1');
        HousingLoanChart::create([
            'name' => $store_request->name,
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
