 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Dashboard - ElectroMart Admin</title>

 <!-- Bootstrap 5.3 CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Bootstrap Icons -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
 <!-- Google Fonts -->
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
 <!-- Custom Admin CSS -->
 <link href="{{ asset('assets/backend/css/admin.css') }}" rel="stylesheet">
 {!! ToastMagic::styles() !!}
 @stack('page_css')
 @stack('page_custom_css')
