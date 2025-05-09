@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Notificacions Push</h1>

        <x-card>
            <div id="notifications" class="notification-container">
                <!-- Aquí se mostrarán las notificaciones -->
                <x-empty-state message="No hi ha notificacions" icon="fa-bell">
                    <p>Les notificacions apareixeran aquí quan es creïn nous vídeos.</p>
                </x-empty-state>
            </div>
        </x-card>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                console.log('DOM carregat');

                if (window.Echo) {
                    console.log('Echo carregat');

                    window.Echo.channel('videos')
                        .listen('video.created', (event) => {
                            console.log('Event rebut:', event);

                            // Eliminar el estado vacío si existe
                            const emptyState = document.querySelector('.empty-state');
                            if (emptyState) {
                                emptyState.remove();
                            }

                            // Crear la notificación
                            const notification = document.createElement('div');
                            notification.classList.add('notification-item');

                            const notificationContent = `
                            <div class="notification-header">
                                <i class="fas fa-video me-2"></i>
                                <strong>Nou Vídeo</strong>
                                <span class="notification-time">${new Date(event.created_at).toLocaleString()}</span>
                            </div>
                            <div class="notification-body">
                                <p><strong>Títol:</strong> ${event.title}</p>
                            </div>
                        `;
                            notification.innerHTML = notificationContent;

                            // Añadir la notificación al contenedor
                            document.getElementById('notifications').appendChild(notification);

                            // Mostrar una notificación temporal
                            window.showNotification(`Nou vídeo creat: ${event.title}`, 'success');
                        });
                } else {
                    console.error('Echo no está disponible!');

                    // Mostrar un mensaje de error
                    window.showNotification('No s\'ha pogut connectar al servidor de notificacions', 'danger');
                }
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .notification-container {
                min-height: 200px;
            }

            .notification-item {
                padding: var(--spacing-md);
                margin-bottom: var(--spacing-md);
                border-radius: var(--border-radius);
                background-color: var(--color-light);
                border-left: 4px solid var(--color-primary);
                box-shadow: var(--box-shadow);
                transition: transform 0.3s ease;
            }

            .notification-item:hover {
                transform: translateY(-2px);
                box-shadow: var(--box-shadow-hover);
            }

            .notification-header {
                display: flex;
                align-items: center;
                margin-bottom: var(--spacing-xs);
                font-size: var(--font-size-md);
            }

            .notification-time {
                margin-left: auto;
                font-size: var(--font-size-sm);
                color: var(--color-secondary);
            }

            .notification-body {
                font-size: var(--font-size-md);
            }
        </style>
    @endpush
@endsection
