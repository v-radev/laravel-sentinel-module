@extends($sentinelClusterLayout)

@section('title')
    File Logs
@endsection

@section('content')
    <div style="padding: 0 20px">
        @if( empty($logs) )
            <div class="well text-center">No logs found.</div>
        @else
            @foreach($logs as $logName => $log)
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>{{ $logName }}</b></h3>
                    </div>
                    <div class="box-body">
                        @foreach($log as $message)
                            {{ $message }} <br/>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
