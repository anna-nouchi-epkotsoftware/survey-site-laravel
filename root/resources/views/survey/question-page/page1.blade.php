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
            @error('usage_situation')
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    {{$message}}
                </div>
            </div>
            @enderror

            <div class="container-fluid p-0 mt-2 mb-4">
                <div class="row">
                    <div class="col">
                        <input type="radio" name="usage_situation" value="1" id="usage_situation1" class="@error('usage_situation') is-invalid @enderror" {{ session('form.page1')==1 ? 'checked' : '' }}>
                        <label for="usage_situation1" class="btn btn-outline-info w-100">借りている</label>
                    </div>
                    <div class="col">
                        <input type="radio" name="usage_situation" value="2" id="usage_situation2" class="@error('usage_situation') is-invalid @enderror" {{ session('form.page1')==2 ? 'checked' : '' }}>
                        <label for="usage_situation2" class="btn btn-outline-info w-100">借りていたが、もう返済が終わった</label>
                    </div>
                    <div class="col">
                        <input type="radio" name="usage_situation" value="3" id="usage_situation3" class="@error('usage_situation') is-invalid @enderror" {{ session('form.page1')==3 ? 'checked' : '' }}>
                        <label for="usage_situation3" class="btn btn-outline-info w-100">借りたことがない</label>
                    </div>
                </div>
            </div>

            <div class="text-end"><input type="submit" value="次へ" class="btn btn-primary"></div>
        </form>
    </div>
</div>
@endsection