<x-filament-widgets::widget>
    <x-filament::card>
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium">Service Health</h3>
            <x-filament::badge color="success">Live</x-filament::badge>
        </div>

        <div class="mt-4 space-y-3">
            @foreach($services as $service)
                <div class="flex items-center justify-between p-2 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full 
                            @if($service->status === 'online') bg-success-500
                            @elseif($service->status === 'warning') bg-warning-500
                            @else bg-danger-500 @endif">
                        </div>
                        <span class="text-sm font-medium">{{ $service->service_name }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500">{{ $service->response_time_ms }}ms</span>
                        <span class="text-xs font-medium
                            @if($service->status === 'online') text-success-600
                            @elseif($service->status === 'warning') text-warning-600
                            @else text-danger-600 @endif">
                            {{ ucfirst($service->status) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::card>
</x-filament-widgets::widget>