<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\HousingLoanChartController;

class ExampleTest extends TestCase
{
    public function testPostPage2()
    {

        // テスト用のリクエストデータを作成
        $requestData = [
            'financial_institution1' => 1,
            'financial_institution2' => 1,
            'financial_institution3' => 1,
            'financial_institution4' => 1,
        ];

        // リクエストを送信
        $response = $this->post('housing-loan/question-page/page2', $requestData);

        // レスポンスを検証
        $response->assertRedirect('/housing-loan/question-page/page3');

        // セッションにデータが正しく保存されたかを検証
        $this->assertEquals($requestData, session('form.page2'));
    }

    public function nameProvider()
    {
        return [
            'Case01: inancial_institution All 1' => [3, 1, 1, 1, 1, "anna"],
            'Case02: inancial_institution All 0' => [3, 0, 0, 0, 0, "anna"],
            'Case03: inancial_institution1 = 1' => [3, 1, 0, 0, 0, "anna"],
            'Case04: inancial_institution2 = 1' => [3, 0, 1, 0, 0, "anna"],
            'Case05: inancial_institution3 = 1' => [3, 0, 0, 1, 0, "anna"],
            'Case06: inancial_institution4 = 1' => [3, 0, 0, 0, 1, '日本語・記号・数値・あa1!?#'],
            'Case07: usage_situation = 2, name min length' => [2, 0, 0, 0, 0, 'a'],
            'Case08: usage_situation = 1,  name max length' => [1, 0, 0, 0, 0, str_repeat('a', 255)],
        ];
    }
    /**
     * @dataProvider nameProvider
     */
    public function testSubmitForm($usage_situation, $financial_institution1, $financial_institution2, $financial_institution3, $financial_institution4, $name)
    {
        // フォームのデータをセッションに保存
        $this->session(['form.page1' => $usage_situation]);
        $this->session(['form.page2' => [
            'financial_institution1' => $financial_institution1,
            'financial_institution2' => $financial_institution2,
            'financial_institution3' => $financial_institution3,
            'financial_institution4' => $financial_institution4,
        ]]);

        $data = [
            'name' => $name,
        ];

        // フォームのデータを送信
        $response = $this->post('housing-loan/question-page/page3', $data);

        // レスポンスのアサーション
        $response->assertRedirect('housing-loan/question-page/last');

        // データベースのアサーション
        $this->assertDatabaseHas('housing_loan_charts', [
            'name' => $name,
            'usage_situation' => $usage_situation,
            'financial_institution1' => $financial_institution1,
            'financial_institution2' => $financial_institution2,
            'financial_institution3' => $financial_institution3,
            'financial_institution4' => $financial_institution4,
        ]);

        // セッションのアサーション
        $this->assertNull(session('form'));
    }
}
