@extends('survey.base')

@section('content')
<!-- プログレスバー -->
<div class="position-relative m-4">
    <div class="progress" style="height: 3px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">1</button>
    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 4rem; height:2rem;">完了</button>
</div>
<!-- ENDプログレスバー -->

<div class="container">

    <p class="fs-5 fw-bold pt-4">1.住宅ローンの利用有無</p>
    <p>あなたご自身、又は配偶者の方は、住宅ローンを借りていますか?</p>
    <div class="row my-4">
        <form method="post" action="{{ route('housing-loan.question-page.page1.postPage1') }}">
            @csrf

            <!-- エラーメッセージを表示 -->
            @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif

            <div class="col">
                <input type="radio" name="usage_situation" value="借りている" id="usage_situation" {{ session('form.page1')=="借りている" ? 'checked' : '' }}>
                <label for="usage_situation">借りている</label>
            </div>
            <div class="col">
                <input type="radio" name="usage_situation" value="借りていたが、もう返済が終わった" id="usage_situation2" {{ session('form.page1')=="借りていたが、もう返済が終わった" ? 'checked' : '' }}>
                <label for="usage_situation2">借りていたが、もう返済が終わった</label>
            </div>
            <div class="col">
                <input type="radio" name="usage_situation" value="借りたことがない" id="usage_situation3" {{ session('form.page1')=="借りたことがない" ? 'checked' : '' }}>
                <label for="usage_situation3">借りたことがない</label>
            </div>

            <input type="submit" value="次へ" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection