@extends('survey.base')

@section('content')
<!-- プログレスバー -->
<div class="position-relative m-4">
    <div class="progress" style="height: 3px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-success rounded-pill" style="width: 2rem; height:2rem;">1</button>
    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 4rem; height:2rem;">完了</button>
</div>
<!-- ENDプログレスバー -->

<div class="container">

    <p class="fs-5 fw-bold pt-4">2.住宅ローンの借入先</p>
    <p>(住宅ローンのある方へ)住宅ローンの借入先はどちらの金融機関ですか?[複数回答]</p>

    <div class="row mt-2">
        <form method="post" action="{{ route('housing-loan.question-page.page2.postPage2') }}">
            @csrf

            <!-- エラーメッセージを表示する -->
            @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif

            <div class="container-fluid p-0 mt-2 mb-4">
                <div class="row mb-2">
                    <div class="col">
                        <input type="checkbox" name="financial_institution1" value="1" id="financial_institution1" {{ isset(session('form.page2')['financial_institution1']) ? 'checked' : ''}}>
                        <label for="financial_institution1" class="btn btn-outline-info w-100">住宅金融公庫</label>
                    </div>
                    <div class="col">
                        <input type="checkbox" name="financial_institution2" value="1" id="financial_institution2" {{ isset(session('form.page2')['financial_institution2']) ? 'checked' : ''}}>
                        <label for="financial_institution2" class="btn btn-outline-info w-100">地方銀行</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="checkbox" name="financial_institution3" value="1" id="financial_institution3" {{ isset(session('form.page2')['financial_institution3']) ? 'checked' : ''}}>
                        <label for="financial_institution3" class="btn btn-outline-info w-100">みずほ銀行</label>
                    </div>
                    <div class="col">
                        <input type="checkbox" name="financial_institution4" value="1" id="financial_institution4" {{ isset(session('form.page2')['financial_institution4']) ? 'checked' : ''}}>
                        <label for="financial_institution4" class="btn btn-outline-info w-100">その他</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-auto me-auto">
                    <a href="{{ route('housing-loan.question-page.page1.showPage1') }}" class="btn btn-secondary">戻る</a>
                </div>
                <div class="col-auto"><input type="submit" value="次へ" class="btn btn-primary"></div>
            </div>
        </form>
    </div>

</div>
@endsection