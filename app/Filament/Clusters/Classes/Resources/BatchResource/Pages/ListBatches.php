<?php

namespace App\Filament\Clusters\Classes\Resources\BatchResource\Pages;

use App\Filament\Clusters\Classes\Resources\BatchResource;
use App\Settings\SchoolSettings;
use Filament\Actions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListBatches extends ListRecords
{
    protected static string $resource = BatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->form([
                    Group::make([
                        Select::make('name')
                            ->prefix(app(SchoolSettings::class)->batch_prefix)
                            ->options(array_combine(range(app(SchoolSettings::class)->batch_start, app(SchoolSettings::class)->batch_end), range(app(SchoolSettings::class)->batch_start, app(SchoolSettings::class)->batch_end)))
                            ->label('Name')
                            ->required()
                            ->unique(),
                        TextInput::make('no_of_sections')
                            ->label('No of Sections')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                    ])
                        ->columns(),
                ])
                ->mutateFormDataUsing(function (array $data) {
                    $data['name'] = app(SchoolSettings::class)->batch_prefix . " " . $data['name'];

                    return $data;
                })
                ->after(function (Model $record, array $data) {
                    $sections = [];
                    $prefix = app(SchoolSettings::class)->section_prefix;
                    $suffixType = app(SchoolSettings::class)->section_suffix_type;
                    $noOfSections = $data['no_of_sections'];

                    for ($i = 1; $i <= $noOfSections; $i++) {
                        switch ($suffixType) {
                            case 'alphabets':
                                $suffix = chr(64 + $i); // A, B, C, ...
                                break;
                            case 'romans':
                                $suffix = strtoupper(romanize($i)); // I, II, III, ...
                                break;
                            case 'numbers':
                            default:
                                $suffix = $i; // 1, 2, 3, ...
                                break;
                        }
                        $sections[$i] = ['name' => $prefix . " " . $suffix];
                    }

                    function romanize($num)
                    {
                        $n = intval($num);
                        $result = '';

                        $lookup = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];

                        foreach ($lookup as $roman => $value) {
                            $matches = intval($n / $value);
                            $result .= str_repeat($roman, $matches);
                            $n = $n % $value;
                        }

                        return $result;
                    }

                    $record->sections()->createMany(
                        $sections
                    );
                }),
        ];
    }
}
