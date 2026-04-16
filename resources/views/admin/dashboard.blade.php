@extends('layouts.backend.master')
@section('content')
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Dashboard</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <!-- Date Range Filter -->
                <div class="input-group input-group-sm" style="width: auto;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar3"></i></span>
                    <input type="text" class="form-control border-start-0" placeholder="Last 30 days"
                        style="width: 130px;">
                </div>
                <button class="btn btn-admin-primary btn-sm">
                    <i class="bi bi-download me-1"></i> Export
                </button>
            </div>
        </div>

        <!-- ===== STAT CARDS ===== -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="stat-card primary">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-label">Total Sales</div>
                            <div class="stat-value">$48,295</div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up"></i> 12.5% from last month
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="stat-card success">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-label">Total Orders</div>
                            <div class="stat-value">1,284</div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up"></i> 8.2% from last month
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="stat-card warning">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-label">Total Products</div>
                            <div class="stat-value">356</div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up"></i> 24 added this month
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="stat-card info">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-label">Total Customers</div>
                            <div class="stat-value">2,847</div>
                            <div class="stat-trend down">
                                <i class="bi bi-arrow-down"></i> 3.1% from last month
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== CHARTS ROW ===== -->
        <div class="row g-3 mb-4">
            <!-- Sales Overview Chart -->
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h6><i class="bi bi-graph-up me-2"></i>Sales Overview</h6>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-secondary active">Monthly</button>
                            <button class="btn btn-sm btn-outline-secondary">Weekly</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Orders by Category -->
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h6><i class="bi bi-pie-chart me-2"></i>Orders by Category</h6>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-three-dots"></i></button>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <canvas id="categoryChart" height="260"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== RECENT ORDERS & LATEST CUSTOMERS ===== -->
        <div class="row g-3">
            <!-- Recent Orders -->
            <div class="col-lg-8">
                <div class="data-table-wrapper">
                    <div class="data-table-header">
                        <h6><i class="bi bi-clock-history me-2"></i>Recent Orders</h6>
                        <a href="orders.html" class="btn btn-admin-outline btn-sm">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table admin-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="order-detail.html" class="fw-600 text-primary">#ORD-1234</a>
                                    </td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">JD</div>
                                            <span class="customer-name">John Doe</span>
                                        </div>
                                    </td>
                                    <td class="fw-600">$1,299.00</td>
                                    <td><span class="status-badge processing"><span class="dot"></span>
                                            Processing</span></td>
                                    <td class="text-muted">Dec 15, 2024</td>
                                </tr>
                                <tr>
                                    <td><a href="order-detail.html" class="fw-600 text-primary">#ORD-1233</a>
                                    </td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar green">SM</div>
                                            <span class="customer-name">Sarah Miller</span>
                                        </div>
                                    </td>
                                    <td class="fw-600">$499.00</td>
                                    <td><span class="status-badge delivered"><span class="dot"></span>
                                            Delivered</span></td>
                                    <td class="text-muted">Dec 14, 2024</td>
                                </tr>
                                <tr>
                                    <td><a href="order-detail.html" class="fw-600 text-primary">#ORD-1232</a>
                                    </td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar orange">RW</div>
                                            <span class="customer-name">Robert Wilson</span>
                                        </div>
                                    </td>
                                    <td class="fw-600">$899.00</td>
                                    <td><span class="status-badge shipped"><span class="dot"></span>
                                            Shipped</span></td>
                                    <td class="text-muted">Dec 14, 2024</td>
                                </tr>
                                <tr>
                                    <td><a href="order-detail.html" class="fw-600 text-primary">#ORD-1231</a>
                                    </td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar blue">EJ</div>
                                            <span class="customer-name">Emily Johnson</span>
                                        </div>
                                    </td>
                                    <td class="fw-600">$179.00</td>
                                    <td><span class="status-badge pending"><span class="dot"></span>
                                            Pending</span></td>
                                    <td class="text-muted">Dec 13, 2024</td>
                                </tr>
                                <tr>
                                    <td><a href="order-detail.html" class="fw-600 text-primary">#ORD-1230</a>
                                    </td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar purple">MC</div>
                                            <span class="customer-name">Michael Chen</span>
                                        </div>
                                    </td>
                                    <td class="fw-600">$2,499.00</td>
                                    <td><span class="status-badge cancelled"><span class="dot"></span>
                                            Cancelled</span></td>
                                    <td class="text-muted">Dec 13, 2024</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Latest Customers -->
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h6><i class="bi bi-person-plus me-2"></i>New Customers</h6>
                        <a href="customers.html" class="btn btn-admin-outline btn-sm">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex align-items-center gap-3 px-4 py-3">
                                <div class="customer-avatar">AS</div>
                                <div class="flex-grow-1">
                                    <div class="customer-name">Alice Smith</div>
                                    <div class="customer-email">alice@email.com</div>
                                </div>
                                <span class="small text-muted">2h ago</span>
                            </div>
                            <div class="list-group-item d-flex align-items-center gap-3 px-4 py-3">
                                <div class="customer-avatar green">BJ</div>
                                <div class="flex-grow-1">
                                    <div class="customer-name">Bob Johnson</div>
                                    <div class="customer-email">bob@email.com</div>
                                </div>
                                <span class="small text-muted">5h ago</span>
                            </div>
                            <div class="list-group-item d-flex align-items-center gap-3 px-4 py-3">
                                <div class="customer-avatar orange">CW</div>
                                <div class="flex-grow-1">
                                    <div class="customer-name">Carol Williams</div>
                                    <div class="customer-email">carol@email.com</div>
                                </div>
                                <span class="small text-muted">1d ago</span>
                            </div>
                            <div class="list-group-item d-flex align-items-center gap-3 px-4 py-3">
                                <div class="customer-avatar blue">DB</div>
                                <div class="flex-grow-1">
                                    <div class="customer-name">David Brown</div>
                                    <div class="customer-email">david@email.com</div>
                                </div>
                                <span class="small text-muted">2d ago</span>
                            </div>
                            <div class="list-group-item d-flex align-items-center gap-3 px-4 py-3">
                                <div class="customer-avatar purple">ED</div>
                                <div class="flex-grow-1">
                                    <div class="customer-name">Eva Davis</div>
                                    <div class="customer-email">eva@email.com</div>
                                </div>
                                <span class="small text-muted">3d ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_css')
    
@endpush
@push('page_custom_css')
  
@endpush

@push('js')
    
@endpush

@push('custom_js')
    <!-- Dashboard Charts Initialization -->
    <script>
        // Sales Overview Line Chart
        const salesCtx = document.getElementById('salesChart');
        if (salesCtx) {
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                            label: 'Revenue',
                            data: [18000, 22000, 19500, 28000, 32000, 29000, 35000, 38000, 42000, 39000, 45000,
                                48295
                            ],
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.08)',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#4f46e5',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 2,
                        },
                        {
                            label: 'Orders',
                            data: [12000, 15000, 13500, 20000, 18000, 22000, 25000, 27000, 30000, 28000, 33000,
                                36000
                            ],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.08)',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#10b981',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 2,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 20,
                                font: {
                                    size: 12,
                                    family: 'Inter'
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: '#1e293b',
                            titleFont: {
                                size: 13,
                                family: 'Inter'
                            },
                            bodyFont: {
                                size: 12,
                                family: 'Inter'
                            },
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(ctx) {
                                    return ctx.dataset.label + ': $' + ctx.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    family: 'Inter'
                                },
                                color: '#94a3b8'
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(0,0,0,0.04)'
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    family: 'Inter'
                                },
                                color: '#94a3b8',
                                callback: function(value) {
                                    return '$' + (value / 1000) + 'k';
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }

        // Category Pie Chart
        const catCtx = document.getElementById('categoryChart');
        if (catCtx) {
            new Chart(catCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Smartphones', 'Laptops', 'Audio', 'Wearables', 'Gaming', 'Other'],
                    datasets: [{
                        data: [35, 25, 15, 10, 10, 5],
                        backgroundColor: ['#4f46e5', '#0ea5e9', '#10b981', '#f59e0b', '#ef4444', '#94a3b8'],
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 16,
                                font: {
                                    size: 11,
                                    family: 'Inter'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: {
                                size: 13,
                                family: 'Inter'
                            },
                            bodyFont: {
                                size: 12,
                                family: 'Inter'
                            },
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(ctx) {
                                    return ' ' + ctx.label + ': ' + ctx.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
@endpush
