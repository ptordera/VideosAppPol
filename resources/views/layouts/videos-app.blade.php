<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>

    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Estilos CSS -->
    <style>
        :root {
            /* Paleta de colores */
            --color-primary: #3498db;
            --color-primary-dark: #2980b9;
            --color-secondary: #2c3e50;
            --color-accent: #e74c3c;
            --color-success: #2ecc71;
            --color-danger: #e74c3c;
            --color-warning: #f39c12;
            --color-info: #3498db;
            --color-light: #f4f4f9;
            --color-dark: #333;
            --color-white: #ffffff;

            /* Tipografía */
            --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            --font-size-sm: 12px;
            --font-size-md: 16px;
            --font-size-lg: 20px;
            --font-size-xl: 24px;

            /* Espaciado */
            --spacing-xs: 5px;
            --spacing-sm: 10px;
            --spacing-md: 15px;
            --spacing-lg: 20px;
            --spacing-xl: 30px;

            /* Bordes y sombras */
            --border-radius: 8px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --box-shadow-hover: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        /* Reset y estilos base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-family);
            font-size: var(--font-size-md);
            line-height: 1.6;
            color: var(--color-dark);
            background-color: var(--color-light);
            margin: 0;
            padding: 0;
        }

        /* Tipografía */
        h1, h2, h3, h4, h5, h6 {
            margin-bottom: var(--spacing-md);
            font-weight: 600;
            line-height: 1.2;
        }

        h1 { font-size: var(--font-size-xl); }
        h2 { font-size: var(--font-size-lg); }
        h3 { font-size: var(--font-size-md); }

        p {
            margin-bottom: var(--spacing-md);
        }

        /* Header y navegación */
        header {
            background-color: var(--color-primary);
            color: var(--color-white);
            padding: var(--spacing-md) 0;
            position: relative;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 var(--spacing-lg);
        }

        .navbar-brand {
            font-size: var(--font-size-lg);
            font-weight: bold;
            color: var(--color-white);
            text-decoration: none;
        }

        .navbar-toggler {
            display: none;
            background: none;
            border: none;
            color: var(--color-white);
            font-size: var(--font-size-lg);
            cursor: pointer;
        }

        .navbar-nav {
            display: flex;
            list-style-type: none;
        }

        .nav-item {
            margin: 0 var(--spacing-sm);
        }

        .nav-link {
            color: var(--color-white);
            text-decoration: none;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--border-radius);
            transition: background-color 0.3s ease;
        }

        .nav-link:hover {
            background-color: var(--color-primary-dark);
        }

        /* Contenedor principal */
        main {
            padding: var(--spacing-xl);
            max-width: 1200px;
            margin: var(--spacing-lg) auto;
            background-color: var(--color-white);
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
        }

        /* Footer */
        footer {
            background-color: var(--color-secondary);
            color: var(--color-white);
            text-align: center;
            padding: var(--spacing-lg) 0;
            margin-top: var(--spacing-xl);
        }

        /* Componentes */

        /* Botones */
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: var(--spacing-sm) var(--spacing-lg);
            font-size: var(--font-size-md);
            line-height: 1.5;
            border-radius: var(--border-radius);
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--box-shadow-hover);
        }

        .btn-primary {
            color: var(--color-white);
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .btn-primary:hover {
            background-color: var(--color-primary-dark);
            border-color: var(--color-primary-dark);
        }

        .btn-success {
            color: var(--color-white);
            background-color: var(--color-success);
            border-color: var(--color-success);
        }

        .btn-danger {
            color: var(--color-white);
            background-color: var(--color-danger);
            border-color: var(--color-danger);
        }

        .btn-sm {
            padding: var(--spacing-xs) var(--spacing-sm);
            font-size: var(--font-size-sm);
        }

        /* Cards */
        .card {
            background-color: var(--color-white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: var(--spacing-lg);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-hover);
        }

        .card-header {
            padding: var(--spacing-md);
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .card-body {
            padding: var(--spacing-lg);
        }

        .card-footer {
            padding: var(--spacing-md);
            background-color: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.125);
        }

        /* Grid para cards */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--spacing-lg);
        }

        /* Tablas */
        .table {
            width: 100%;
            margin-bottom: var(--spacing-lg);
            color: var(--color-dark);
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: var(--spacing-md);
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            text-align: left;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: var(--color-light);
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        /* Alertas y notificaciones */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: var(--spacing-md) var(--spacing-lg);
            margin-bottom: var(--spacing-md);
            border: 1px solid transparent;
            border-radius: var(--border-radius);
            z-index: 1000;
            box-shadow: var(--box-shadow);
            animation: slideIn 0.3s ease-out forwards;
            max-width: 400px;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        /* Utilidades */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }

        .mt-1 { margin-top: var(--spacing-xs); }
        .mt-2 { margin-top: var(--spacing-sm); }
        .mt-3 { margin-top: var(--spacing-md); }
        .mt-4 { margin-top: var(--spacing-lg); }
        .mt-5 { margin-top: var(--spacing-xl); }

        .mb-1 { margin-bottom: var(--spacing-xs); }
        .mb-2 { margin-bottom: var(--spacing-sm); }
        .mb-3 { margin-bottom: var(--spacing-md); }
        .mb-4 { margin-bottom: var(--spacing-lg); }
        .mb-5 { margin-bottom: var(--spacing-xl); }

        .mx-auto { margin-left: auto; margin-right: auto; }

        .d-flex { display: flex; }
        .justify-content-between { justify-content: space-between; }
        .align-items-center { align-items: center; }

        .w-100 { width: 100%; }

        /* Mensaje de no contenido */
        .empty-state {
            text-align: center;
            padding: var(--spacing-xl);
            background-color: var(--color-light);
            border-radius: var(--border-radius);
            margin: var(--spacing-lg) 0;
        }

        .empty-state i {
            font-size: 48px;
            color: var(--color-secondary);
            margin-bottom: var(--spacing-md);
        }

        /* Media queries para responsive */
        @media (max-width: 768px) {
            .navbar-toggler {
                display: block;
            }

            .navbar-nav {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 100%;
                left: 0;
                background-color: var(--color-primary);
                padding: var(--spacing-md);
                z-index: 1000;
            }

            .navbar-nav.show {
                display: flex;
            }

            .nav-item {
                margin: var(--spacing-xs) 0;
            }

            main {
                padding: var(--spacing-md);
            }

            /* Convertir tablas a lista en móvil */
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
            }

            .table-responsive-list thead {
                display: none;
            }

            .table-responsive-list tbody tr {
                display: block;
                margin-bottom: var(--spacing-lg);
                border: 1px solid #dee2e6;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
            }

            .table-responsive-list tbody td {
                display: flex;
                justify-content: space-between;
                text-align: right;
                border-top: none;
                border-bottom: 1px solid #dee2e6;
            }

            .table-responsive-list tbody td:last-child {
                border-bottom: none;
            }

            .table-responsive-list tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                text-align: left;
            }

            /* Ajustar grid de cards */
            .card-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sistema de notificaciones -->
<div id="notification-container"></div>

<header>
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">VideosApp</a>

        <button class="navbar-toggler" id="navbar-toggler" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-nav" id="navbar-nav">
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Inici</a></li>
            <li class="nav-item"><a href="{{ route('videos.index') }}" class="nav-link">Vídeos</a></li>
            <li class="nav-item"><a href="{{ route('series.index') }}" class="nav-link">Series</a></li>

            @if (Auth::check())
                <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link">Usuaris</a></li>
            @endif

            @if (Auth::check() && Auth::user()->can('manage-videos'))
                <li class="nav-item"><a href="{{ route('videos.manage.index') }}" class="nav-link">Manage Videos</a></li>
            @endif

            @if (Auth::check() && Auth::user()->can('manage-users'))
                <li class="nav-item"><a href="{{ route('users.manage.index') }}" class="nav-link">Manage Users</a></li>
            @endif

            @if (Auth::check() && Auth::user()->can('manage-series'))
                <li class="nav-item"><a href="{{ route('series.manage.index') }}" class="nav-link">Manage Series</a></li>
            @endif

            @if (Auth::check())
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                        Tancar sessió
                    </a>
                </li>
            @else
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Iniciar sessió</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrar-se</a></li>
            @endif
        </ul>
    </nav>
</header>

<main>
    @if (session('success'))
        <div class="alert alert-success" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert" id="error-alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert" id="error-alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} VideosApp. Tots els drets reservats. Pol Tordera Gil</p>
</footer>

<!-- Scripts -->
<script>
    // Toggle para el menú móvil
    document.addEventListener('DOMContentLoaded', function() {
        const navbarToggler = document.getElementById('navbar-toggler');
        const navbarNav = document.getElementById('navbar-nav');

        if (navbarToggler && navbarNav) {
            navbarToggler.addEventListener('click', function() {
                navbarNav.classList.toggle('show');
            });
        }

        // Cerrar alertas automáticamente después de 5 segundos
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.animation = 'slideOut 0.3s ease-out forwards';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            }, 5000);
        });

        // Función para mostrar notificaciones
        window.showNotification = function(message, type = 'success') {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = `alert alert-${type}`;
            notification.textContent = message;

            container.appendChild(notification);

            setTimeout(function() {
                notification.style.animation = 'slideOut 0.3s ease-out forwards';
                setTimeout(function() {
                    notification.remove();
                }, 300);
            }, 5000);
        };
    });
</script>

@stack('scripts')
</body>
</html>
