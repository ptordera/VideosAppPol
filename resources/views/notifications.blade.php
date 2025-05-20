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
                padding: 1rem;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                background-color: white;
                border-left: 4px solid #3b82f6;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                transition: transform 0.3s ease;
            }

            .notification-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .notification-header {
                display: flex;
                align-items: center;
                margin-bottom: 0.5rem;
                font-size: 1rem;
            }

            .notification-time {
                margin-left: auto;
                font-size: 0.875rem;
                color: #6b7280;
            }

            .notification-body {
                font-size: 1rem;
            }

            /* Estilos responsivos para móviles */
            @media (max-width: 768px) {
                .notification-item {
                    padding: 0.75rem;
                    margin-bottom: 0.75rem;
                }

                .notification-header {
                    flex-wrap: wrap;
                }

                .notification-time {
                    width: 100%;
                    margin-left: 0;
                    margin-top: 0.25rem;
                    font-size: 0.75rem;
                }
            }
        </style>
    @endpush
@endsection
