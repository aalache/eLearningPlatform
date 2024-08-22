// notification timeout
document.addEventListener('DOMContentLoaded', function() {
    const notifications = document.querySelectorAll('.notif-card');
    notifications.forEach(notif => {
        setTimeout(function() {
            if (notif) {
                notif.classList.add('hidden');
            }
        }, 4000);
    });
})