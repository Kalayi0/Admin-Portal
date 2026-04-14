<?php

namespace App\Filament\Widgets;

use App\Models\ServiceStatus;
use Filament\Widgets\Widget;

class ServiceHealthWidget extends Widget
{
    protected string $view = 'filament.widgets.service-health-widget';

    public function getServices()
    {
        return ServiceStatus::all();
    }

    protected function getViewData(): array
    {
        return [
            'services' => $this->getServices(),
        ];
    }
}