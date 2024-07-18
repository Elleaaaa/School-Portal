function fetchNotifications() {
    $.ajax({
        url: '/notifications',
        method: 'GET',
        success: function(data) {
            $('.notification-list').html('');

            if (data.length === 0) {
                $('.notification-list').append(`
                    <li class="notification-message text-center"> <!-- Added 'text-center' class here -->
                        <p class="noti-details">You have no new messages.</p>
                    </li>
                `);
            } else {
                data.forEach(function(notification) {
                    // Format the created_at timestamp
                    let notificationCreatedAt = new Date(notification.created_at);
                    let formattedDate = `${notificationCreatedAt.getMonth() + 1}/${notificationCreatedAt.getDate()}/${notificationCreatedAt.getFullYear()}`;

                    $('.notification-list').append(`
                        <li class="notification-message" data-id="${notification.id}">
                            <a href="#">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">${notification.title}</span> ${notification.message}</p>
                                        <p class="noti-time"><span class="notification-time">${formattedDate}</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    `);
                });
            }
            $('.badge-pill').text(data.length);
        }
    });
}


fetchNotifications();

setInterval(fetchNotifications, 60000); // Refresh notifications every 60 seconds

$('.clear-noti').on('click', function() {
    $.ajax({
        url: '/notifications/clear-all',
        method: 'POST',
        success: function(data) {
            fetchNotifications();
        }
    });
});

$('.notification-list').on('click', '.notification-message', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '/notifications/mark-as-read/' + id,
        method: 'POST',
        success: function(data) {
            fetchNotifications();
        }
    });
});