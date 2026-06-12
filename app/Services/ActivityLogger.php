<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogger
{
    public static function log(
        string $action,
        ?string $description = null,
        ?string $targetType = null,
        ?int $targetId = null
    ): ActivityLog {
        $request = request();

        $userType = null;
        $userId = null;
        $userName = null;

        if (session('role') === 'admin') {
            $userType = 'admin';
            $userId = session('admin_id');
            $userName = session('admin_nama');
        } elseif (session('role') === 'shelter') {
            $userType = 'shelter';
            $userId = session('shelter_id');
            $userName = session('shelter_nama');
        } elseif (session('role') === 'donatur') {
            $userType = 'donatur';
            $userId = session('donatur_id');
            $userName = session('donatur_nama');
        }

        return ActivityLog::create([
            'user_type'   => $userType,
            'user_id'     => $userId,
            'user_name'   => $userName,
            'action'      => $action,
            'description' => $description,
            'target_type' => $targetType,
            'target_id'   => $targetId,
            'ip_address'  => $request?->ip(),
        ]);
    }
}
