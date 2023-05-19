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
            'テスト'
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
            ["借りている", "住宅金融公庫", "地方銀行","みずほ銀行","その他","anna"],
            ["借りている", "", "","","","anna"],
            ["借りている", "住宅金融公庫", "","","","anna"],
            ["借りている", "", "地方銀行","","","anna"],
            ["借りている", "", "","みずほ銀行","","anna"],
            ["借りている", "", "","","その他","anna"],
            ["借りている", "住宅金融公庫", "地方銀行","","","anna"],
            ["借りている", "", "地方銀行","みずほ銀行","","anna"],
            ["借りている", "", "","みずほ銀行","その他","anna"],
            ["借りている", "住宅金融公庫", "","","その他","anna"],
            ["借りている", "", "地方銀行","みずほ銀行","その他","anna"],
            ["借りている", "住宅金融公庫", "","みずほ銀行","その他","anna"],
            ["借りている", "住宅金融公庫", "地方銀行","","その他","anna"],
            ["借りている", "住宅金融公庫", "地方銀行","みずほ銀行","","anna"],
            ["借りていたが、もう返済が終わった", "住宅金融公庫", "地方銀行","みずほ銀行","その他","anna"],
            ["借りていたが、もう返済が終わった", "", "","","","anna"],
            ["借りていたが、もう返済が終わった", "住宅金融公庫", "","","","anna"],
            ["借りていたが、もう返済が終わった", "", "地方銀行","","","anna"],
            ["借りていたが、もう返済が終わった", "", "","みずほ銀行","","anna"],
            ["借りていたが、もう返済が終わった", "", "","","その他","anna"],
            ["借りていたが、もう返済が終わった", "住宅金融公庫", "地方銀行","","","anna"],
            ["借りていたが、もう返済が終わった", "", "地方銀行","みずほ銀行","","anna"],
            ["借りていたが、もう返済が終わった", "", "","みずほ銀行","その他","anna"],
            ["借りていたが、もう返済が終わった", "住宅金融公庫", "","","その他","anna"],
            ["借りていたが、もう返済が終わった", "", "地方銀行","みずほ銀行","その他","anna"],
            ["借りていたが、もう返済が終わった", "住宅金融公庫", "","みずほ銀行","その他","anna"],
            ["借りていたが、もう返済が終わった", "住宅金融公庫", "地方銀行","","その他","anna"],
            ["借りていたが、もう返済が終わった", "住宅金融公庫", "地方銀行","みずほ銀行","","anna"],
            ["借りたことがない", "", "","","","anna"],
        ];
    }
    /**
     * @dataProvider nameProvider
     */
    public function testSubmitForm($usage_situation,$financial_institution,$financial_institution2,$financial_institution3,$financial_institution4,$name)
    {
        // フォームのデータをセッションに保存
        $this->session(['form.page1' => $usage_situation]);
        $this->session(['form.page2' => [
            'financial_institution' => $financial_institution,
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
            'financial_institution' => $financial_institution,
            'financial_institution2' => $financial_institution2,
            'financial_institution3' => $financial_institution3,
            'financial_institution4' => $financial_institution4,
        ]);

        // セッションのアサーション
        $this->assertNull(session('form'));
    }
}
