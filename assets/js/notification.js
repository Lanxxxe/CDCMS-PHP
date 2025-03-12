document.addEventListener("DOMContentLoaded", function () {
    const notificationBell = document.querySelector(".nav-notif");
    const notificationCount = document.getElementById("notification-count");
    const notificationContainer = document.querySelector(".list-group");
    const notificationsUrl = "{% url 'get_notifications' %}";  // Update with your actual URL name
    const markReadUrl = "{% url 'mark_notifications_as_read' %}";

    function fetchNotifications() {
        axios.get("/teacher/notifications/")
            .then(response => {
                const data = response.data;
                notificationContainer.innerHTML = ""; // Clear old notifications

                if (data.unread_count > 0) {
                    notificationCount.textContent = data.unread_count;
                    notificationCount.style.display = "flex"; // Show red circle
                } else {
                    notificationCount.style.display = "none"; // Hide red circle
                }

                if (data.notifications.length > 0) {
                    data.notifications.forEach(n => {
                        let notificationHTML = `
                            <div class="alert alert-primary alert-dismissible fade show d-flex align-items-center justify-content-start" role="alert" id="notification">
                                ${n.file_path ? `<img class="fade show" src="${n.file_path}" width="35" height="35">` : `<img class="fade show" src="{% static '/images/unified-lgu-logo.png' %}" width="35" height="35">`}
                                <strong>${n.name}</strong> ${n.action} a file.<br>
                            </div>`;
                        notificationContainer.innerHTML += notificationHTML;
                    });
                } else {
                    notificationContainer.innerHTML = `<div id="no-notifications" style="text-align:center; margin-top:10px;">No notifications</div>`;
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }

    function markNotificationsAsRead() {
        axios.post("/teacher/notifications/read/")
            .then(() => {
                fetchNotifications(); // Refresh after marking as read
            })
            .catch(error => console.error("Error marking notifications as read:", error));
    }

    notificationBell.addEventListener("click", function () {
        markNotificationsAsRead();
    });

    fetchNotifications();
});