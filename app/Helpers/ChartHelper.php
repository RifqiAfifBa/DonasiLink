<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class ChartHelper
{
    /**
     * Get database-agnostic date format function
     */
    private static function getDateFormatSQL($column)
    {
        $driver = DB::getDriverName();

        return match ($driver) {
            'sqlite' => "strftime('%Y-%m', $column)",
            'pgsql' => "to_char($column, 'YYYY-MM')",
            default => "DATE_FORMAT($column, '%Y-%m')", // MySQL, MariaDB
        };
    }

    /**
     * Format donation timeline data for Donatur Dashboard
     * Returns labels and dataset for line chart
     */
    public static function getDonationTimelineData($donatur, $months = 6)
    {
        $now = now();
        $startDate = $now->copy()->subMonths($months);

        $monthFormat = self::getDateFormatSQL('created_at');

        $donations = $donatur->donasi()
            ->where('status', 'berhasil')
            ->where('created_at', '>=', $startDate)
            ->selectRaw("$monthFormat as month, SUM(jumlah) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        for ($i = $months; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $labels[] = $date->format('M Y');

            $donation = $donations->firstWhere('month', $monthKey);
            $data[] = $donation ? $donation->total : 0;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Donasi Berhasil',
                    'data' => $data,
                    'borderColor' => '#ec4899',
                    'backgroundColor' => 'rgba(236, 72, 153, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'borderWidth' => 2,
                ]
            ]
        ];
    }

    /**
     * Format fund distribution data for Campaign Detail
     * Returns pie chart data showing Medis/Pakan/Operasional/Saldo
     */
    public static function getCampaignFundDistribution($kampanye)
    {
        $penarikan = $kampanye->penarikan()
            ->where('status', 'Berhasil')
            ->get();

        // Group by category (from keterangan field or deskripsi_penggunaan)
        $medis = 0;
        $pakan = 0;
        $operasional = 0;

        foreach ($penarikan as $p) {
            $desc = strtolower($p->deskripsi_penggunaan ?? $p->keterangan ?? '');

            if (strpos($desc, 'medis') !== false || strpos($desc, 'obat') !== false) {
                $medis += $p->total_penarikan;
            } elseif (strpos($desc, 'pakan') !== false || strpos($desc, 'makanan') !== false) {
                $pakan += $p->total_penarikan;
            } else {
                $operasional += $p->total_penarikan;
            }
        }

        $totalDisalurkan = $medis + $pakan + $operasional;
        $saldo = max(0, $kampanye->total_terkumpul - $totalDisalurkan);

        return [
            'labels' => ['Medis', 'Pakan', 'Operasional', 'Saldo'],
            'datasets' => [
                [
                    'data' => [$medis, $pakan, $operasional, $saldo],
                    'backgroundColor' => [
                        '#ef4444',  // red for medical
                        '#f59e0b',  // amber for feed
                        '#3b82f6',  // blue for operational
                        '#8b5cf6',  // purple for balance
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                ]
            ]
        ];
    }

    /**
     * Format transaction volume data for Admin Dashboard
     * Returns bar chart data showing transactions over time
     */
    public static function getTransactionVolumeData($months = 6)
    {
        $now = now();
        $startDate = $now->copy()->subMonths($months);

        $monthFormat = self::getDateFormatSQL('created_at');

        $donations = \App\Models\Donasi::where('status', 'berhasil')
            ->where('created_at', '>=', $startDate)
            ->selectRaw("$monthFormat as month, COUNT(*) as count, SUM(jumlah) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $penarikan = \App\Models\Penarikan::where('status', 'Berhasil')
            ->where('created_at', '>=', $startDate)
            ->selectRaw("$monthFormat as month, COUNT(*) as count, SUM(total_penarikan) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $donationCounts = [];
        $withdrawalCounts = [];

        for ($i = $months; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $labels[] = $date->format('M Y');

            $donation = $donations->firstWhere('month', $monthKey);
            $withdrawal = $penarikan->firstWhere('month', $monthKey);

            $donationCounts[] = $donation ? $donation->count : 0;
            $withdrawalCounts[] = $withdrawal ? $withdrawal->count : 0;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Donasi Berhasil',
                    'data' => $donationCounts,
                    'backgroundColor' => '#ec4899',
                ],
                [
                    'label' => 'Penarikan Berhasil',
                    'data' => $withdrawalCounts,
                    'backgroundColor' => '#10b981',
                ]
            ]
        ];
    }
}
