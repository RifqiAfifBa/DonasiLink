<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Donatur;
use App\Models\Shelter;
use App\Models\Admin;

class NotificationService
{
    /**
     * Create notification for donatur
     */
    public static function notifyDonatur(
        Donatur $donatur,
        string $type,
        string $title,
        string $message,
        ?string $relatedModel = null,
        ?int $relatedId = null,
        ?array $data = null
    ): Notification {
        return Notification::create([
            'donatur_id' => $donatur->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'related_model' => $relatedModel,
            'related_id' => $relatedId,
            'data' => $data,
        ]);
    }

    /**
     * Create notification for shelter
     */
    public static function notifyShelter(
        Shelter $shelter,
        string $type,
        string $title,
        string $message,
        ?string $relatedModel = null,
        ?int $relatedId = null,
        ?array $data = null
    ): Notification {
        return Notification::create([
            'shelter_id' => $shelter->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'related_model' => $relatedModel,
            'related_id' => $relatedId,
            'data' => $data,
        ]);
    }

    /**
     * Create notification for admin
     */
    public static function notifyAdmin(
        Admin $admin,
        string $type,
        string $title,
        string $message,
        ?string $relatedModel = null,
        ?int $relatedId = null,
        ?array $data = null
    ): Notification {
        return Notification::create([
            'admin_id' => $admin->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'related_model' => $relatedModel,
            'related_id' => $relatedId,
            'data' => $data,
        ]);
    }

    /**
     * Notify all admins
     */
    public static function notifyAllAdmins(
        string $type,
        string $title,
        string $message,
        ?string $relatedModel = null,
        ?int $relatedId = null,
        ?array $data = null
    ): void {
        $admins = Admin::all();
        foreach ($admins as $admin) {
            static::notifyAdmin($admin, $type, $title, $message, $relatedModel, $relatedId, $data);
        }
    }

    /**
     * Notify donors of a campaign when proof is uploaded (impact notification)
     */
    public static function notifyDonorsOfImpact(
        int $kampanyeId,
        string $title,
        string $message,
        ?array $data = null
    ): void {
        $donations = \App\Models\Donasi::where('kampanye_id', $kampanyeId)
            ->where('status', 'berhasil')
            ->distinct('donatur_id')
            ->pluck('donatur_id');

        foreach ($donations as $donaturId) {
            $donatur = Donatur::find($donaturId);
            if ($donatur) {
                static::notifyDonatur(
                    $donatur,
                    'notifikasi_dampak',
                    $title,
                    $message,
                    'Kampanye',
                    $kampanyeId,
                    $data
                );
            }
        }
    }
}
