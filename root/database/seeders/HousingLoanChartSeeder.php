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
                    'usage_situation' => 3,
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
                        'usage_situation' => 1,
                        'financial_institution1' => true,
                        'financial_institution2' => false,
                        'financial_institution3' => false,
                        'financial_institution4' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                } else {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => 1,
                        'financial_institution1' => true,
                        'financial_institution2' => true,
                        'financial_institution3' => false,
                        'financial_institution4' => false,
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
                        'usage_situation' => 1,
                        'financial_institution1' => false,
                        'financial_institution2' => false,
                        'financial_institution3' => true,
                        'financial_institution4' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                } else {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => 1,
                        'financial_institution1' => false,
                        'financial_institution2' => false,
                        'financial_institution3' => false,
                        'financial_institution4' => true,
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
                        'usage_situation' => 2,
                        'financial_institution1' => true,
                        'financial_institution2' => false,
                        'financial_institution3' => false,
                        'financial_institution4' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                } else {
                    $data = [
                        'name' => fake()->name,
                        'usage_situation' => 2,
                        'financial_institution1' => true,
                        'financial_institution2' => true,
                        'financial_institution3' => false,
                        'financial_institution4' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    DB::table('housing_loan_charts')->insert($data);
                }
            }
        }
    }
}
