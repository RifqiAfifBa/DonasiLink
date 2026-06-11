@props(['id', 'title', 'type' => 'line', 'data' => [], 'options' => []])

<x-card padding="p-7">
    <h3 class="flex items-center gap-2 text-base font-bold text-ink-900 dark:text-white mb-5">
        @if($type === 'line')
        <i class="fas fa-chart-line text-brand-500"></i>
        @elseif($type === 'pie')
        <i class="fas fa-chart-pie text-brand-500"></i>
        @elseif($type === 'bar')
        <i class="fas fa-chart-bar text-brand-500"></i>
        @else
        <i class="fas fa-chart-simple text-brand-500"></i>
        @endif
        {{ $title }}
    </h3>

    <div class="relative h-96 mb-4">
        <canvas id="{{ $id }}" class="max-h-96"></canvas>
    </div>
</x-card>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('{{ $id }}').getContext('2d');

        const defaultOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: getComputedStyle(document.documentElement).getPropertyValue('--color-ink-900'),
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        padding: 15
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: getComputedStyle(document.documentElement).getPropertyValue('--color-ink-100'),
                    }
                },
                x: {
                    grid: {
                        color: getComputedStyle(document.documentElement).getPropertyValue('--color-ink-100'),
                    }
                }
            }
        };

        const mergedOptions = Object.assign({}, defaultOptions, @json($options));

        new Chart(ctx, {
            type: '{{ $type }}',
            data: @json($data),
            options: mergedOptions
        });
    });
</script>