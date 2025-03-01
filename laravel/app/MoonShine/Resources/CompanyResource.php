<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

use MoonShine\Resources\ModelResource;
use \MoonShine\Fields\Text;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\BelongsTo;

class CompanyResource extends ModelResource
{
    protected string $model = Company::class;

    protected string $title = 'Companies';
    protected string $column = 'name';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                    Text::make("Название","name"),
                    Text::make("Телефон","phone")->mask("+7 999 999-99-99"),
                    Text::make("Почта","email"),
                    Text::make("Адрес","address"),
            ]),
        ];
    }

    /**
     * @param Company $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            "name" => ["required", "string", "min:5", "max:255"], 
            "phone" => ["nullable", "string", "min:11", "max:20"],
            "email" => ["nullable", "string", "min:5", "max:255"],
            "address" => ["nullable", "string", "min:5", "max:255"],
        ];
    }
}
