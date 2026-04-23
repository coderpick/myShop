@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Products</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.product.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-lg"></i> Add Product
            </a>
        </div>

        <!-- Alert -->
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert"
            id="successAlert" style="display: none !important;">
            <i class="bi bi-check-circle-fill me-2"></i>
            <span id="alertMessage">Product saved successfully!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-box-seam me-2"></i>All Products <span
                        class="badge bg-primary bg-opacity-10 text-primary ms-1">356</span></h6>
                <div class="data-table-actions">
                    <div class="data-table-search">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search products...">
                    </div>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>All Categories</option>
                        <option>Smartphones</option>
                        <option>Laptops</option>
                        <option>Audio</option>
                        <option>Wearables</option>
                        <option>Gaming</option>
                    </select>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                    <button class="btn btn-admin-outline btn-sm">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th><input class="form-check-input" type="checkbox" id="selectAll"></th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Product Row 1 -->
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>
                                <div class="product-cell">
                                    <img src="https://via.placeholder.com/44x44/f1f5f9/4f46e5?text=IP" alt="Product">
                                    <div>
                                        <div class="product-name">Apple iPhone 15 Pro 256GB</div>
                                        <div class="product-sku">SKU: APL-IP15P-256</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">Smartphones</span></td>
                            <td>
                                <div class="fw-600">$999.00</div>
                                <div class="small text-muted text-decoration-line-through">$1,199.00</div>
                            </td>
                            <td>
                                <span class="fw-600">45</span>
                                <div class="progress mt-1" style="height: 3px; width: 60px;">
                                    <div class="progress-bar bg-success" style="width: 45%;"></div>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View"><i class="bi bi-eye"></i></button>
                                    <a href="add-product.html" class="action-btn edit" title="Edit"><i
                                            class="bi bi-pencil"></i></a>
                                    <button class="action-btn delete" title="Delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product Row 2 -->
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>
                                <div class="product-cell">
                                    <img src="https://via.placeholder.com/44x44/f1f5f9/1e293b?text=MB" alt="Product">
                                    <div>
                                        <div class="product-name">MacBook Air M2 15" 512GB</div>
                                        <div class="product-sku">SKU: APL-MBA15-512</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-info bg-opacity-10 text-info">Laptops</span></td>
                            <td>
                                <div class="fw-600">$1,299.00</div>
                                <div class="small text-muted text-decoration-line-through">$1,499.00</div>
                            </td>
                            <td>
                                <span class="fw-600">28</span>
                                <div class="progress mt-1" style="height: 3px; width: 60px;">
                                    <div class="progress-bar bg-warning" style="width: 28%;"></div>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View"><i class="bi bi-eye"></i></button>
                                    <a href="add-product.html" class="action-btn edit" title="Edit"><i
                                            class="bi bi-pencil"></i></a>
                                    <button class="action-btn delete" title="Delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product Row 3 -->
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>
                                <div class="product-cell">
                                    <img src="https://via.placeholder.com/44x44/f1f5f9/059669?text=SN" alt="Product">
                                    <div>
                                        <div class="product-name">Sony WH-1000XM5 Wireless</div>
                                        <div class="product-sku">SKU: SNY-XM5-BLK</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success bg-opacity-10 text-success">Audio</span></td>
                            <td>
                                <div class="fw-600">$299.00</div>
                                <div class="small text-muted text-decoration-line-through">$399.00</div>
                            </td>
                            <td>
                                <span class="fw-600 text-danger">3</span>
                                <div class="progress mt-1" style="height: 3px; width: 60px;">
                                    <div class="progress-bar bg-danger" style="width: 3%;"></div>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        checked></div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                    <a href="add-product.html" class="action-btn edit"><i class="bi bi-pencil"></i></a>
                                    <button class="action-btn delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product Row 4 -->
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>
                                <div class="product-cell">
                                    <img src="https://via.placeholder.com/44x44/f1f5f9/d97706?text=GS" alt="Product">
                                    <div>
                                        <div class="product-name">Samsung Galaxy S24 Ultra</div>
                                        <div class="product-sku">SKU: SAM-GS24U-256</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">Smartphones</span></td>
                            <td>
                                <div class="fw-600">$1,199.00</div>
                            </td>
                            <td>
                                <span class="fw-600">62</span>
                                <div class="progress mt-1" style="height: 3px; width: 60px;">
                                    <div class="progress-bar bg-success" style="width: 62%;"></div>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        checked></div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                    <a href="add-product.html" class="action-btn edit"><i class="bi bi-pencil"></i></a>
                                    <button class="action-btn delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product Row 5 - Inactive -->
                        <tr class="opacity-75">
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td>
                                <div class="product-cell">
                                    <img src="https://via.placeholder.com/44x44/f1f5f9/94a3b8?text=PS" alt="Product">
                                    <div>
                                        <div class="product-name">PlayStation 5 Digital Edition</div>
                                        <div class="product-sku">SKU: SNY-PS5D-001</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger">Gaming</span></td>
                            <td>
                                <div class="fw-600">$399.00</div>
                            </td>
                            <td>
                                <span class="fw-600 text-danger">0</span>
                                <div class="progress mt-1" style="height: 3px; width: 60px;">
                                    <div class="progress-bar bg-danger" style="width: 0%;"></div>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox">
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                    <a href="add-product.html" class="action-btn edit"><i class="bi bi-pencil"></i></a>
                                    <button class="action-btn delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer / Pagination -->
            <div class="data-table-footer">
                <span class="showing-text">Showing <strong>1</strong> to <strong>5</strong> of <strong>356</strong>
                    entries</span>
                <nav>
                    <ul class="pagination admin-pagination mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#"><i
                                    class="bi bi-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">36</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i
                                    class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@push('page_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>
@endpush
@push('custom_js')
    <script>
        new DataTable('#Brand');
    </script>
@endpush
