<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<div>
    <p class="body_title">留言板</p>
</div>
<div class="body_show_region form_radius">
    <table>
    @foreach($boardList as $data)
    <tr>
        <td class="form_td">
            <div>
            <img class="upload_img" 
            @if($data->User->picture == "")
                src="/images/nopic.png" 
            @else
                src="/{{ $data->User->picture }}" 
            @endif
            />
            </div>
            <div class="td_text">
                {{ $data->User->name }}
            </div>
        </td>
        <td class="form_td form_text">
            <div class="td_title">E-mail：{{ $data->email }}</div>
            <div class="td_main">{{!! $data->content !!}}</div>
            <div class="td_text">發表時間：{{ $data->created_at }}</div>
        </td>
    </tr>
    @endforeach
    </table>
    <form action = "" method="POST" class="normal_form" />
        <!-- 自動產生 csrf_token 隱藏欄位-->
        {!! csrf_field() !!}
        <div class="col-sm-6">
            <div class="form_label">電子郵件:</div>
            <div class="form_textbox_region">
                <input name="email" class="form_textbox" type="text" value="{{ $input['email'] ?? '' }}" placeholder="請輸入電子郵件"/>
            </div>
        </div>
        <div class="div_clear"/>
        <textarea name="content" id="content">
            {{ $input['content'] ?? '' }}
        </textarea>
        <div class="btn_group">
            <input class="btn btn-primary btn_form" type = 'submit' value = '送出'>
        <div>
        <div class="form_error">
            <!-- 錯誤訊息模板元件 -->
            @include('layout.ValidatorError')
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection