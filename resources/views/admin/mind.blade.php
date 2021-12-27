<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<form method="post" action="/admin/mind/edit">
<!-- 自動產生 csrf_token 隱藏欄位-->
{!! csrf_field() !!}
<input name="id" type="hidden" value="{{ $Mind->id }}"/>
<div class="normal_form">
    <div class="form_title">{{ $action }}心情隨筆</div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">心情隨筆</label>
        <textarea class="form-control" name="content" rows="3">{{ $Mind->content }}</textarea>
    </div>

    <div class="btn_group">
        <button type="button" class="btn btn-warning btn_form" onclick="Cancel()">取消</button>
        <button type="summit" class="btn btn-primary btn_form">{{ $action }}</button>
    </div>
    <div class="form_error">
        <!-- 錯誤訊息模板元件 -->
        @include('layout.ValidatorError')
    </div>
<div>
</form>

<script>
function Cancel()
{
    location.href = "/admin/mind";
}
</script>
@endsection