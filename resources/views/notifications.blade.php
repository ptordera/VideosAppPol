<x-videos-app-layout>
    <h1>Notificacións Push</h1>

    <div id="notifications" style="margin-top: 20px;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM carregat');

            if (window.Echo) {
                console.log('Echo carregat');

                window.Echo.channel('videos')
                    .listen('video.created', (event) => {
                        console.log('Event rebut:', event);

                        const notification = document.createElement('div');
                        notification.classList.add('notification');

                        const notificationContent = `
                            <strong>Nou Video</strong><br>
                            Titol: ${event.title}<br>
                            Data de creació: ${new Date(event.created_at).toLocaleString()}
                        `;
                        notification.innerHTML = notificationContent;

                        document.getElementById('notifications').appendChild(notification);
                    });
            } else {
                console.error('Echo no está disponible!');
            }
        });
    </script>

</x-videos-app-layout>
