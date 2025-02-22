<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Resources\ModelResource;
use \MoonShine\Fields\Text;
use \MoonShine\Fields\Json;
use \MoonShine\Fields\Url;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make("Название","full_name"),
                Text::make("Телефон","phone")->mask("+7 999 999-99-99"),
                Text::make("Почта","email"),
                Json::make("social","social_links")->fields([
                    Text::make("Название соц сети","social_name"),
                    Url::make("Ссылка","social_link"),
                ]),

                \MoonShine\Fields\Relationships\BelongsTo::make("company", resource: new CompanyResource()),
             ]),    
            
        ];
    }

    /**
     * @param User $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            "full_name" => ["required", "string", "min:5", "max:255"], 
            "phone" => ["nullable", "string", "min:11", "max:20"],
            "email" => ["nullable", "string", "min:5", "max:255"],
        ];
    }
}
