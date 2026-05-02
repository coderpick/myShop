 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="ElectroMart - Your one-stop shop for electronics, gadgets, and accessories">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>@yield('pageTitle', 'ElectroMart') - Premium Electronics Store</title>

 <!-- Bootstrap 5.3 CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Bootstrap Icons -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
 <!-- Google Fonts -->
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
 <!-- Custom CSS -->
 <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">
 @stack('page_styles')
