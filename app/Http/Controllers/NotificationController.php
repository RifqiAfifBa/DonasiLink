<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * Get notifications — JSON for dropdown, view for full page
     */
    public function index(Request $request): JsonResponse|\Illuminate\View\View
    {
        $userId = $this->getUserId();
        $userType = $this->getUserType();

        if (!$userId || !$userType) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['notifications' => [], 'unread_count' => 0]);
            }
            return redirect()->route('login');
        }

        $query = Notification::where($this->getWhereColumn($userType), $userId);
        $unreadCount = (clone $query)->whereNull('read_at')->count();

        // JSON response for dropdown
        if ($request->expectsJson() || $request->ajax()) {
            $notifications = $query->latest()->take(10)->get();
            return response()->json([
                'notifications' => $notifications,
                'unread_count' => $unreadCount,
            ]);
        }

        // HTML view for full page
        $notifications = $query->latest()->paginate(20);
        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(Notification $notification): JsonResponse
    {
        if (!$this->isOwnNotification($notification)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(): JsonResponse
    {
        $userId = $this->getUserId();
        $userType = $this->getUserType();

        if (!$userId || !$userType) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        Notification::where($this->getWhereColumn($userType), $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Get unread count only
     */
    public function getUnreadCount(): JsonResponse
    {
        $userId = $this->getUserId();
        $userType = $this->getUserType();

        if (!$userId || !$userType) {
            return response()->json(['unread_count' => 0]);
        }

        $unreadCount = Notification::where($this->getWhereColumn($userType), $userId)
            ->whereNull('read_at')
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }

    /**
     * Delete a notification
     */
    public function destroy(Notification $notification): JsonResponse
    {
        if (!$this->isOwnNotification($notification)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Get current user ID from session
     */
    private function getUserId(): ?int
    {
        return session('donatur_id') ?? session('shelter_id') ?? session('admin_id');
    }

    /**
     * Get current user type from session
     */
    private function getUserType(): ?string
    {
        if (session('donatur_id')) {
            return 'donatur';
        } elseif (session('shelter_id')) {
            return 'shelter';
        } elseif (session('admin_id')) {
            return 'admin';
        }
        return null;
    }

    /**
     * Get the column name for WHERE clause based on user type
     */
    private function getWhereColumn(string $userType): string
    {
        return match ($userType) {
            'donatur' => 'donatur_id',
            'shelter' => 'shelter_id',
            'admin' => 'admin_id',
            default => 'donatur_id',
        };
    }

    /**
     * Check if notification belongs to current user
     */
    private function isOwnNotification(Notification $notification): bool
    {
        $userId = $this->getUserId();
        $userType = $this->getUserType();

        if (!$userId || !$userType) {
            return false;
        }

        $column = $this->getWhereColumn($userType);
        return $notification->$column === $userId;
    }
}
