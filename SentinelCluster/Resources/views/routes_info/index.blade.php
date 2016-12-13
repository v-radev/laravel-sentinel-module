@extends($sentinelClusterLayout)

@section('title')
    Routes Info
@endsection

@section('content')
    <div style="padding: 0 20px">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Routes info</h3>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Path</th>
                        <th>Methods</th>
                        <th>Prefix</th>
                        <th>Action</th>
                        <th>Middleware</th>
                    </thead>
                    <tbody>
                    @foreach($routesInfo as $routeInfo)
                        <tr>
                            <td>{{ $routeInfo['name'] }}</td>
                            <td>{{ $routeInfo['path'] }}</td>
                            <td>{{ implode('|', $routeInfo['methods']) }}</td>
                            <td>{{ $routeInfo['prefix'] }}</td>
                            <td>{{ $routeInfo['actionname'] }}</td>
                            <td>{{ implode('|', $routeInfo['middleware']) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
