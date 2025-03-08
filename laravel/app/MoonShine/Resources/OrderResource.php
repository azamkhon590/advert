<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

use MoonShine\Resources\ModelResource;
use \MoonShine\Fields\Text;
use \MoonShine\Fields\Textarea;
use MoonShine\Fields\Number;
use \MoonShine\Fields\Json;
use \MoonShine\Fields\Select;
use \MoonShine\Fields\RelationShips\BelongsToMany;
use MoonShine\Fields\Date;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Models\MoonshineUser;
use MoonShine\Models\MoonShineUserResource;
use App\Models\moonShineUsersOrder;

/**
 * @extends ModelResource<Order>
 */
class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Orders';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Textarea::make("Название","description"),
                Date::make("date_start","date_start"),
                Date::make("date_end","date_end"),
                Select::make('status', 'status')
                ->options([
                    'in_progress' => 'in_progress',
                    'in_progress' => 'complate',
                    'fail' => 'fail',
                    'freeze' => 'freeze',
                ]),
                Text::make("budget"),
                Json::make("comments","comments")->fields([
                    Text::make("name","name"),
                    Textarea::make("text","text"),
                ]),
                BelongsToMany::make("Categories","Categories", resource: new OrderCategoryResource())->selectMode(),
                BelongsToMany::make("Users","Users", resource: new \MoonShine\Resources\MoonShineUserResource())->selectMode(),
            ]),
        ];
    }

    /**
     * @param Order $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            "description" => ["nullable", "string"], 
            "date_start" => ["nullable", "date" ],
            "date_end" => ["nullable", "date"],
            "status" => ["required", "string"],
            "budget" => ["nullable", "integer" ],
        ];
    }
}
