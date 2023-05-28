<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>住宅ローンについての集計結果</title>
    <!-- bootstrapのcss -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- css読み込み -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>

<body>

    <header class="base-header">
        <h1 class="p-3">住宅ローンについての集計結果</h1>
    </header>

    <!--1,住宅ローンの利用有無円グラフ-->
    <div class="container p-3">

        <div style="border: 1px solid;">
            <p class="fs-4 fw-bold ps-4 mt-2">1.住宅ローンの利用有無</p>
            <p class="ps-4 mb-0">[あなたご自身、又は配偶者の方は、住宅ローンを借りていますか?]</p>
            <div style="width: 30%;" class="mx-auto">
                <canvas id="usageSituation"></canvas>
            </div>
        </div>

    </div>
    <!-- Content end -->
    <!--2,住宅ローンの借入先棒グラフ-->
    <div class="container p-3">

        <div style="border: 1px solid;">
            <p class="fs-4 fw-bold ps-4 mt-2">2.住宅ローンの借入先</p>
            <p class="ps-4 mb-0">(住宅ローンのある方へ)住宅ローンの借入先はどちらの金融機関ですか?[複数回答]</p>
            <div style="width: 70%;" class="mx-auto">
                <canvas id="financialInstitution"></canvas>
            </div>
        </div>

    </div>
    <!-- Content end -->


    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>
    <script>
        //住宅ローン利用状況の円グラフ作成
        (() => {
            //データをJS用に変換
            const data = {{Js::from($aggregateResultsOfUsage)}};
            const title = {{Js::from($usageSituationTitleList)}};

            //canvasの値取得
            const ctx = document.getElementById('usageSituation');

            //円グラフの設定
            const config = {
                type: 'doughnut',
                data: {
                    labels: title,
                    datasets: [{
                        label: '住宅ローンの利用有無',
                        data: data,
                        backgroundColor: [
                            "rgba(126,162,255,0.7)",
                            "rgba(216,255,184,0.8)",
                            "rgba(209,209,209,0.8)",
                        ],
                    }]
                },
                plugins: [ChartDataLabels], // pluginとしてchartdatalabelsを追加
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20
                            }
                        },
                        datalabels: {
                            //dataに%をつける
                            formatter: function(value, context) {
                                return value + '%';
                            }
                        }
                    }
                }
            };
            //グラフ作成
            new Chart(ctx, config);
        })();

        //住宅ローンの借入先の棒グラフ
        (() => {
            //データをJS用に変換
            const data = {{Js::from($financialInstitutionList)}};

            //canvasの値取得
            const ctx = document.getElementById('financialInstitution');

            //円グラフの設定
            const config = {
                type: 'bar',
                data: {
                    labels: ['住宅金融公庫', '地方銀行', 'みずほ銀行', 'その他'],
                    datasets: [{
                        label: '住宅ローンの借入先',
                        data: data,
                        backgroundColor: [
                            "rgba(126,162,255,0.7)",
                            "rgba(126,162,255,0.7)",
                            "rgba(126,162,255,0.7)",
                            "rgba(126,162,255,0.7)",
                        ],
                    }]
                },
                plugins: [ChartDataLabels], // pluginとしてchartdatalabelsを追加
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            min: 0,
                            max: 100,
                            ticks: {
                                stepSize: 10,
                                font: {
                                    size: 18,
                                    weight:'bold'
                                }
                            },
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 20,
                                    weight:'bold'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        datalabels: {
                            formatter: function(value, context) {
                                return value + '%';
                            }
                        }
                    }
                }
            };



            //グラフ作成
            new Chart(ctx, config);
        })();
    </script>
    <!-- bootstrapのjs -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>