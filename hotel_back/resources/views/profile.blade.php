<!DOCTYPE html>
    <body>
        <h1>Welcome to profile- {{$name}}</h1>
        <h1>Your id is- {{$id}}</h1>
        <ul>
            @foreach($info as $n)
                <li>{{$n}}</li>
            @endforeach
        </ul>
    </body>

</html>