<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<div>
    <p class="body_title">自我介紹</p>
</div>
<div class="body_show_region form_radius">
    <div class="">
        <div class="col-sm-3">
            <span class='body_form_title' >姓名：{{ $userData->name }}</span>
        </div>
        <div class="col-sm-3">
            <span class='body_form_title' >性別：{{ $userData->sex }}</span>
        </div>
        <div class="col-sm-3">
            <span class='body_form_title' >身高：{{ $userData->height }} cm</span>
        </div>
        <div class="col-sm-3">
            <span class='body_form_title' >體重：{{ $userData->weight }} Kg</span>
        </div>
    </div>
    <div class="div_clear"></div>
    <div class="body_form_row">
        <div class="col-sm-2">
            <span class='body_form_title' >圖片：</span>
        </div>
        <div class="col-sm-10">
            <img class="body_img"
            @if($userData->picture == "")
                src="/images/nopic.png" 
            @else
                src="/{{ $userData->picture }}" 
            @endif
            />
        </div>
    </div>
    <div class="div_clear"></div>
    <div class="body_form_row">
        <div class="col-sm-2">
            <span class='body_form_title'>興趣：</span>
        </div>
        <div class="col-sm-10">
            <span class='body_form_title'>{{ $userData->interest }}</span>
        </div>
    </div>
    <div class="div_clear"></div>
    <div class="body_form_row">
        <div class="col-sm-2">
            <span class='body_form_title'>自我介紹：</span>
        </div>
        <div class="col-sm-10">
            <span class='body_form_title'>{{ $userData->introduce }}</span>
        </div>
    </div>
</div>
@endsection