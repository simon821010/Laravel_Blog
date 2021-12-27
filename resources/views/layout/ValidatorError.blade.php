@if($errors AND count($errors))
    <ul style='color:red;'>
        @foreach($errors->all() as $err)
            <li> {{ $err }} </li>
        @endforeach
    </ul>
@endif