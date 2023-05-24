@extends('survey.base')

@section('content')
<!-- プログレスバー -->
<div class="position-relative m-4">
  <div class="progress" style="height: 3px;">
    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-success rounded-pill" style="width: 2rem; height:2rem;">1</button>
  <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-success rounded-pill" style="width: 2rem; height:2rem;">2</button>
  <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 4rem; height:2rem;">完了</button>
</div>
<!-- ENDプログレスバー -->

<div class="row my-4">

  <form method="post" action="{{ route('housing-loan.question-page.page3.submitForm') }}">
    @csrf

    <div class="col mb-3">
      <p class="fs-4 fw-bold">連絡先の入力をお願いいたします。</p>
      
      @error('name')
      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </svg>
        <div>
          {{$message}}
        </div>
      </div>
      @enderror

      <label for="name" class="fw-bold">氏名</label>
      <span class="badge bg-danger me-4">必須</span>
      <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror">
    </div>


    <div class="row">
      <div class="col-auto me-auto">
        <!-- 問1の回答によって、戻る時遷移する場所を切り替えている -->
        @if(session('form.page1')=="借りたことがない")
        <a href="{{ route('housing-loan.question-page.page1.showPage1') }}" class="btn btn-secondary">戻る</a>
        @else
        <a href="{{ route('housing-loan.question-page.page2.showPage2') }}" class="btn btn-secondary">戻る</a>
        @endif
      </div>
      <div class="col-auto"><input type="submit" value="回答する" class="btn btn-primary"></div>
    </div>
  </form>

</div>
@endsection