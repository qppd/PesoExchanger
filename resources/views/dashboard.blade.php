@include('includes/header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
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
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
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
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>₱ {{ number_format($totals['day'], 2) }}</h3>
                                    <p>This Day</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-peso-sign"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>₱ {{ number_format($totals['week'], 2) }}</h3>
                                    <p>This Week</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-peso-sign"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>₱ {{ number_format($totals['month'], 2) }}</h3>
                                    <p>This Month</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-peso-sign"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>₱ {{ number_format($totals['year'], 2) }}</h3>
                                    <p>This Year</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-peso-sign"></i>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <!-- Card 1: Coin Dispenser -->
                        <div class="col-12 col-md-12">
                            <div class="card" style="width:100%;">
                                <div
                                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                                    <!-- Title on the Left -->
                                    <h4 class="card-title mb-2 mb-md-0">Peso Exchanger Stock</h4>

                                    <!-- Controls on the Right -->
                                    <div class="d-flex flex-wrap align-items-right">

                                        <!-- Fee Update Form -->
                                        <form method="POST" action="{{ route('settings.updateFee') }}"
                                            class="form-inline mr-2 mb-2">
                                            @csrf
                                            <label for="machine_fee" class="mr-2 mb-0">Fee (%)</label>
                                            <div class="input-group input-group-sm mr-2">
                                                <input type="number" name="fee" id="fee"
                                                    class="form-control form-control-sm" step="1" min="0"
                                                    max="100" value="{{ $settings['fee'] ?? 5 }}">
                                            </div>
                                            <button type="submit" class="btn btn-light btn-sm">Update</button>
                                        </form>

                                        <!-- Reset Stocks Button -->
                                        <form method="POST" action="{{ route('stocks.reset') }}" class="mb-2">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-rotate-left mr-1"></i> Reset Stocks
                                            </button>
                                        </form>

                                    </div>
                                </div>


                                <div class="card-body">
                                    <!-- Coin Stock Info -->
                                    <div class="row">
                                        <!-- 1 Peso Stock -->
                                        <div class="col-md-3">
                                            <div class="info-box bg-light">
                                                <span class="info-box-icon bg-info"><i
                                                        class="fa-solid fa-peso-sign"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">₱ 1</span>
                                                    <span class="info-box-number">{{ $stocks['1'] ?? 0 }} pcs</span>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- 5 Peso Stock -->
                                        <div class="col-md-3">
                                            <div class="info-box bg-light">
                                                <span class="info-box-icon bg-success"><i
                                                        class="fa-solid fa-peso-sign"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">₱ 5</span>
                                                    <span class="info-box-number">{{ $stocks['5'] ?? 0 }} pcs</span>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- 10 Peso Stock -->
                                        <div class="col-md-3">
                                            <div class="info-box bg-light">
                                                <span class="info-box-icon bg-warning"><i
                                                        class="fa-solid fa-peso-sign"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">₱ 10</span>
                                                    <span class="info-box-number">{{ $stocks['10'] ?? 0 }} pcs</span>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- 20 Peso Stock -->
                                        <div class="col-md-3">
                                            <div class="info-box bg-light">
                                                <span class="info-box-icon bg-danger"><i
                                                        class="fa-solid fa-peso-sign"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">₱ 20</span>
                                                    <span class="info-box-number">{{ $stocks['20'] ?? 0 }} pcs</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="card" style="width:100%;">
                                <div class="card-header bg-navy text-white">
                                    <h4 class="card-title">Earnings Graph</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Monthly Sales Chart -->
                                    <canvas id="salesChart" height="200"></canvas>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <script>
                                        var ctx = document.getElementById('salesChart').getContext('2d');
                                        var salesChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: [
                                                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                                ],
                                                datasets: [{
                                                    label: 'Monthly Earnings (₱)',
                                                    data: @json($monthlyTotals),
                                                    backgroundColor: 'rgba(54, 162, 235, 0.4)',
                                                    borderColor: 'rgba(54, 162, 235, 1)',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                },
                                                responsive: true
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>

        @include('includes/footer')
        @include('includes/scripts')
    </div>


</body>

</html>
