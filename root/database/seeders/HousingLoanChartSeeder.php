<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HousingLoanChart;


class HousingLoanChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //// 開発環境のみ100レコードを追加する。
        if (app()->isLocal()) {
            HousingLoanChart::truncate();
            HousingLoanChart::factory()
                ->count(200)
                ->create();
        }
    }
}
