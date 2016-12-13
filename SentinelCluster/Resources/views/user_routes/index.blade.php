@extends($sentinelClusterLayout)

@section('title')
    User Route Logs
@endsection

@section('content')
    <div style="padding: 0 20px">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User route logs list</h3>
            </div>
            <div class="box-body">
                @if( $logs->isEmpty() )
                    <div class="well text-center">No logs found.</div>
                @else
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>IP</th>
                            <th>Method</th>
                            <th>Route</th>
                            <th>URL</th>
                            <th>User</th>
                            <th>User Agent</th>
                            <th>Time</th>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->ip }}</td>
                                <td>{{ $log->method }}</td>
                                <td>{{ $log->route_name }}</td>
                                <td>{{ substr($log->url, 0, 150) }}</td>
                                <td>{{ $log->user ? $log->user->email : 'GUEST' }}</td>
                                <td>{{ $log->user_agent }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div>{{ $logs->links() }}</div>
@endsection
