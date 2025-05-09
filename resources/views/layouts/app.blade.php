<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estilos CSS adicionales -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

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
            --font-family: 'Figtree', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        /* Estilos para el área principal */
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
            main {
                padding: var(--spacing-md);
                margin: var(--spacing-md) auto;
            }

            /* Ajustar grid de cards */
            .card-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Styles -->
    @livewireStyles

    @stack('styles')
</head>
<body class="font-sans antialiased">
<x-banner />

<!-- Sistema de notificaciones -->
<div id="notification-container"></div>

<div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
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

        @hasSection('content')
            @yield('content')
        @else
            @isset($slot)
                {{ $slot }}
            @endisset
        @endif
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} VideosApp. Tots els drets reservats. Pol Tordera Gil</p>
    </footer>
</div>

@stack('modals')

@livewireScripts

<!-- Scripts -->
<script>
    // Cerrar alertas automáticamente después de 5 segundos
    document.addEventListener('DOMContentLoaded', function() {
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
