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

<h1>お名前を記入してください。</h1>

<div class="row my-4">

  <form method="post" action="{{ route('housing-loan.question-page.page3.submitForm') }}">
    @csrf

    <div class="col">
      <label for="name">お名前：</label>
      <input type="text" name="name" id="name">
    </div>

    <input type="submit" value="回答する" class="btn btn-primary">
  </form>

</div>
<!-- 問1の回答によって、戻る時遷移する場所を切り替えている -->
@if(session('form.page1')=="借りたことがない")
<a href="{{ route('housing-loan.question-page.page1.showPage1') }}" class="btn btn-secondary">戻る</a>
@else
<a href="{{ route('housing-loan.question-page.page2.showPage2') }}" class="btn btn-secondary">戻る</a>
@endif

@endsection