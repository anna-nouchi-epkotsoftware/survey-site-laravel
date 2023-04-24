@extends('survey.base')

@section('content')
<div class="position-relative m-4">
    <div class="progress" style="height: 3px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-success rounded-pill" style="width: 2rem; height:2rem;">1</button>
    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 4rem; height:2rem;">完了</button>
</div>
<div class="container">

    <p class="fs-5 fw-bold pt-4">2,住宅ローンの借入先</p>
    <p>(住宅ローンのある方へ)住宅ローンの借入先はどちらの金融機関ですか?[複数回答]</p>

    <div class="row mt-2">
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">住宅金融公庫</button>
        </div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">地方銀行</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">みずほ銀行</button>
        </div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">三菱UFJ銀行</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">りそな銀行</button>
        </div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">その他</button>
        </div>
    </div>
    <div class="row d-flex mt-4">
        <div class="col"><a href="#" class="btn btn-secondary">戻る</a></div>
        <div class="col text-end"><a href="#" class="btn btn-primary">次へ</a></div>
    </div>

</div>
@endsection