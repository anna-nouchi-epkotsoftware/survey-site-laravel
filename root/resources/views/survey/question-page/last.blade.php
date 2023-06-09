@extends('survey.base')

@section('content')
<div class="position-relative m-4">
  <div class="progress" style="height: 3px;">
    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-success rounded-pill" style="width: 2rem; height:2rem;">1</button>
  <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-success rounded-pill" style="width: 2rem; height:2rem;">2</button>
  <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-success rounded-pill" style="width: 4rem; height:2rem;">完了</button>
</div>

<h1>質問は以上になります。ご協力いただきありがとうございます。</h1>

<a href="{{ route('housing-loan.index') }}" class="btn btn-primary btn-lg">集計結果</a>

@endsection