<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Pages\Page;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Metrics\LineChartMetric;
use App\Models\Order;
use App\Models\OrderCategory;
use App\Models\Company;
use App\Models\User;
use MoonShine\Components\MoonShineComponent;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [
            ValueMetric::make('Orders')
            ->value(Order::count()),
            ValueMetric::make('Companies')
            ->value(Company::count()),
            ValueMetric::make('Users')
            ->value(User::count()),
            ValueMetric::make('OrderCategories')
            ->value(OrderCategory::count()),

            LineChartMetric::make('Orders')
            ->line([
                'Profit' => Order::query()
                    ->selectRaw('SUM(budget) as budget, DATE_FORMAT(date_end, "%d.%m.%Y") as date')
                    ->groupBy('date')
                    ->pluck('budget','date')
                    ->toArray()
            ])
            

        ];
	}
}
