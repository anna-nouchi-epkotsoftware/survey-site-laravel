@extends('survey.base')

@section('content')

<p class="fs-5">回答時間の目安： 1分</p>
<p class="fs-5 border-bottom border-secondary pb-5">住宅ローンに関する簡単なアンケートになります。<br />
    ご協力の程をお願いいたします。
</p>
<a href="{{ route('housing-loan.question-page.page1.showPage1') }}" class="btn btn-primary btn-lg">はじめる</a>

@endsection