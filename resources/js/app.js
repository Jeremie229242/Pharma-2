import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (Laravel.userId) {
    window.Echo.private(`user.${Laravel.userId}`)
        .listen('.session.replaced', (e) => {
            alert("⚠️ Votre session a été remplacée par une nouvelle connexion !");
            window.location.href = '/login';
        });
}

