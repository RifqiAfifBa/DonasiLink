<div class="relative group">
    <button type="button"
        id="notificationBellBtn"
        class="relative p-2 text-ink-600 dark:text-ink-300 hover:text-brand-600 dark:hover:text-brand-300 rounded-full hover:bg-brand-50 dark:hover:bg-ink-800 transition-colors">
        <i class="fas fa-bell text-lg"></i>
        <span id="notificationBadge"
            class="absolute top-0 right-0 w-5 h-5 rounded-full bg-rose-500 text-white text-xs font-bold flex items-center justify-center hidden">
            <span id="unreadCount">0</span>
        </span>
    </button>

    <!-- Notification Dropdown -->
    <div id="notificationDropdown"
        class="hidden absolute right-0 mt-2 w-96 bg-white dark:bg-ink-900 rounded-2xl shadow-xl ring-1 ring-black/5 dark:ring-white/5 overflow-hidden z-50 group-hover:block hover:block">

        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-ink-100 dark:border-ink-800 bg-ink-50 dark:bg-ink-800/50">
            <h3 class="text-sm font-bold text-ink-900 dark:text-white">Notifikasi</h3>
            <button type="button"
                id="markAllReadBtn"
                class="text-xs font-semibold text-brand-600 dark:text-brand-300 hover:underline">
                Tandai semua dibaca
            </button>
        </div>

        <!-- Notifications List -->
        <div id="notificationsList" class="max-h-96 overflow-y-auto divide-y divide-ink-100 dark:divide-ink-800">
            <div class="px-5 py-8 text-center">
                <i class="fas fa-inbox text-3xl text-ink-300 dark:text-ink-600 mb-2 block"></i>
                <p class="text-sm text-ink-500 dark:text-ink-400">Tidak ada notifikasi</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-5 py-3 border-t border-ink-100 dark:border-ink-800 bg-ink-50 dark:bg-ink-800/50">
            <a href="{{ route('notifications.index') }}" class="text-xs font-semibold text-brand-600 dark:text-brand-300 hover:underline">
                Lihat semua notifikasi →
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationBellBtn = document.getElementById('notificationBellBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationsList = document.getElementById('notificationsList');
        const unreadCountBadge = document.getElementById('notificationBadge');
        const unreadCountSpan = document.getElementById('unreadCount');
        const markAllReadBtn = document.getElementById('markAllReadBtn');

        // Toggle dropdown
        notificationBellBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
            if (!notificationDropdown.classList.contains('hidden')) {
                loadNotifications();
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#notificationBellBtn') && !e.target.closest('#notificationDropdown')) {
                notificationDropdown.classList.add('hidden');
            }
        });

        // Load notifications
        function loadNotifications() {
            fetch('{{ route("notifications.index") }}')
                .then(response => response.json())
                .then(data => {
                    updateUnreadCount(data.unread_count);
                    renderNotifications(data.notifications);
                })
                .catch(error => console.error('Error loading notifications:', error));
        }

        // Update unread count badge
        function updateUnreadCount(count) {
            if (count > 0) {
                unreadCountBadge.classList.remove('hidden');
                unreadCountSpan.textContent = count > 9 ? '9+' : count;
            } else {
                unreadCountBadge.classList.add('hidden');
            }
        }

        // Render notifications in dropdown
        function renderNotifications(notifications) {
            if (notifications.length === 0) {
                notificationsList.innerHTML = `
                <div class="px-5 py-8 text-center">
                    <i class="fas fa-inbox text-3xl text-ink-300 dark:text-ink-600 mb-2 block"></i>
                    <p class="text-sm text-ink-500 dark:text-ink-400">Tidak ada notifikasi</p>
                </div>
            `;
                return;
            }

            notificationsList.innerHTML = notifications.map(notif => {
                const bgClass = notif.read_at ? '' : 'bg-brand-50 dark:bg-brand-900/20';
                const unreadDot = notif.read_at ? '' : '<span class="w-2 h-2 rounded-full bg-brand-500 mt-1"></span>';
                return `
            <div class="px-5 py-3 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-colors ${bgClass}">
                <div class="flex items-start gap-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-ink-900 dark:text-white">${notif.title}</p>
                        <p class="text-xs text-ink-500 dark:text-ink-400 mt-1 line-clamp-2">${notif.message}</p>
                        <p class="text-[11px] text-ink-400 dark:text-ink-500 mt-1">${formatTime(notif.created_at)}</p>
                    </div>
                    <div class="flex-shrink-0 flex gap-2">
                        ${unreadDot}
                        <button type="button" 
                                onclick="deleteNotification(${notif.id})"
                                class="text-ink-400 hover:text-rose-600 dark:hover:text-rose-300 transition-colors">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
            }).join('');
        }

        // Mark all as read
        markAllReadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            fetch('{{ route("notifications.markAllAsRead") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(() => loadNotifications())
                .catch(error => console.error('Error:', error));
        });

        // Format time
        function formatTime(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const diff = now - date;
            const seconds = Math.floor(diff / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);

            if (days > 0) return `${days} hari yang lalu`;
            if (hours > 0) return `${hours} jam yang lalu`;
            if (minutes > 0) return `${minutes} menit yang lalu`;
            return 'Baru saja';
        }

        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);

        // Initial load
        loadNotifications();
    });

    function deleteNotification(id) {
        fetch(`{{ route('notifications.destroy', ':id') }}`.replace(':id', id), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                document.getElementById('notificationsList').innerHTML = '<div class="px-5 py-8 text-center"><i class="fas fa-inbox text-3xl text-ink-300 dark:text-ink-600 mb-2 block"></i><p class="text-sm text-ink-500 dark:text-ink-400">Loading...</p></div>';
                // Reload notifications
                fetch('{{ route("notifications.index") }}')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('unreadCount').textContent = data.unread_count > 9 ? '9+' : data.unread_count;
                        if (data.unread_count === 0) {
                            document.getElementById('notificationBadge').classList.add('hidden');
                        }
                        renderNotifications(data.notifications);
                    });
            })
            .catch(error => console.error('Error:', error));
    }

    // Make renderNotifications globally accessible
    window.renderNotifications = function(notifications) {
        const notificationsList = document.getElementById('notificationsList');
        if (notifications.length === 0) {
            notificationsList.innerHTML = `
            <div class="px-5 py-8 text-center">
                <i class="fas fa-inbox text-3xl text-ink-300 dark:text-ink-600 mb-2 block"></i>
                <p class="text-sm text-ink-500 dark:text-ink-400">Tidak ada notifikasi</p>
            </div>
        `;
            return;
        }

        notificationsList.innerHTML = notifications.map(notif => `
        <div class="px-5 py-3 hover:bg-ink-50 dark:hover:bg-ink-800/50 transition-colors ${notif.read_at ? '' : 'bg-brand-50 dark:bg-brand-900/20'}">
            <div class="flex items-start gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-ink-900 dark:text-white">${notif.title}</p>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mt-1 line-clamp-2">${notif.message}</p>
                    <p class="text-[11px] text-ink-400 dark:text-ink-500 mt-1">${formatTime(notif.created_at)}</p>
                </div>
                <div class="flex-shrink-0 flex gap-2">
                    ${notif.read_at ? '' : '<span class="w-2 h-2 rounded-full bg-brand-500 mt-1"></span>'}
                    <button type="button" 
                            onclick="deleteNotification(${notif.id})"
                            class="text-ink-400 hover:text-rose-600 dark:hover:text-rose-300 transition-colors">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join('');
    };
</script>