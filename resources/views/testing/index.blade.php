<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="5"><a href="{{route('testingCreate')}}" >Add New User</a></th>
                </tr>
                <tr>
                    <th>Sr.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($users)
                    @if($users->count())
                        @foreach($users as $k=>$u)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$u->first_name}}</td>
                                <td>{{$u->last_name}}</td>
                                <td>{{$u->email}}</td>
                                <td><a href="{{route('testingEdit',['id'=>$u->id])}}" >Edit</a></td>
                                <td><a href="#" >Delete</a></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">{{$users->links()}}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5"> There is no record</td>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td colspan="5"> There is no record</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </body>
</html>