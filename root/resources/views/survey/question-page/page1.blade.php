@extends('survey.base')

@section('content')
<div class="position-relative m-4">
    <div class="progress" style="height: 3px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">1</button>
    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 4rem; height:2rem;">完了</button>
</div>

<div class="container">

    <p class="fs-5 fw-bold pt-4">1,住宅ローンの利用有無</p>
    <p>あなたご自身、又は配偶者の方は、住宅ローンを借りていますか?</p>
    <div class="row my-4">
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">借りている</button>
        </div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">借りていたが、もう返済が終わった</button>
        </div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary w-100">借りたことがない</button>
        </div>
    </div>

    <div class="text-end"><a href="{{ route('page2') }}" class="btn btn-primary">次へ</a></div>
</div>



@endsection