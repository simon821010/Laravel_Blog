<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')

<div class="main_region">
@foreach($userList as $user)
<div class="col-10">
    <img class="circle_img" alt="{{ $user->name }}" title="{{ $user->name }}" onclick="ChangeUser({{ $user->id }})"
    @if($user->picture == "")
        src="/images/nopic.png" 
    @else
        src="/{{ $user->picture }}" 
    @endif
    />
</div>
@endforeach
</div>

<script>
function ChangeUser(id)
{
    location.href = "/" + id + "/user";
}
</script>
@endsection