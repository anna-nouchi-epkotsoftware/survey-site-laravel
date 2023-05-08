<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HousingLoanChart;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class HousingLoanChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 開発環境のみレコードを追加する。
        if (app()->isLocal()) {

            //借りたことがない
            for ($i = 0; $i < 100; $i++) {
                $data = [
                    'name' => fake()->name,
                    'usage_situation' => '借りたことがない',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                DB::table('housing_loan_charts')->insert($data);
            }
            //借りている
            for ($i = 0; $i < 20; $i++) {
                if ($i % 2 === 0) {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => '借りている',
                        'financial_institution' => '住宅金融公庫',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                } else {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => '借りている',
                        'financial_institution' => '住宅金融公庫',
                        'financial_institution2' => '地方銀行',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                }
            }
            for ($i = 0; $i < 20; $i++) {
                if ($i % 2 === 0) {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => '借りている',
                        'financial_institution3' => 'みずほ銀行',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                } else {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => '借りている',
                        'financial_institution4' => 'その他',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                }
            }
            //借りていたが、もう返済が終わった
            for ($i = 0; $i < 20; $i++) {
                if ($i % 2 === 0) {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => '借りていたが、もう返済が終わった',
                        'financial_institution' => '住宅金融公庫',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                } else {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => '借りていたが、もう返済が終わった',
                        'financial_institution' => '住宅金融公庫',
                        'financial_institution2' => '地方銀行',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                }
            }
        }
    }
}
