@include('includes/header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/applogo.png') }}" alt="AAC" height="180"
                width="180">
            <h1>PESO EXCHANGER</h1>
        </div>
        @include('includes/navbar')
        @include('includes/menubar')
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Reports</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                @if ($errors->any())
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        <ul>
                            {{ session()->get('success') }}
                        </ul>
                    </div>
                @endif
                <div class="container-fluid">
                    <div class="row">
                        <div class="card" style="width:100%;">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Received Amount</th>
                                            <th>Dispensed Amount</th>
                                            <th>Earnings</th>
                                            <th>Denominations</th>
                                            <th>Status</th>
                                            <th>Datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($reports) && count($reports) > 0)
                                            @foreach ($reports as $index => $report)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td><strong>₱{{ number_format($report['received_amount'], 2) }}</strong>
                                                    </td>

                                                    <td><strong>₱{{ number_format($report['dispensed_amount'], 2) }}</strong>
                                                    </td>

                                                    <td><strong>₱{{ number_format($report['earnings'], 2) }}</strong>
                                                    </td>

                                                    <td>
                                                        @foreach ($report['denominations'] as $denomLabel => $denomValue)
                                                            <b>{{ $denomLabel }}:</b> {{ $denomValue }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>

                                                    @if ($report['status'] == 'processing')
                                                        <td><span class="badge badge-success">Incomplete</span></td>
                                                    @elseif ($report['status'] == 'completed')
                                                        <td><span class="badge badge-primary">Completed</span></td>
                                                    @endif
                                                    <td>{{ $report['datetime'] }}</td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
            </section>
        </div>
    </div>
    </section>
    </div>
    @include('includes/footer')
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>
    @include('includes/scripts')

</body>

</html>
