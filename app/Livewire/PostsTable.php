<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PostsTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Post::query()
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageVisibilityDisabled();
        $this->setDefaultPerPage(25);
        $this->setPaginationEnabled();
        $this->setColumnSelectStatus(false);
        $this->setEmptyMessage('No articles have been added yet');
    }

    public function columns(): array
    {
        return [
            Column::make("Title", "title")
                ->searchable()
                ->sortable(),
            Column::make("Author", "user_id")
                ->format(
                    fn($value, $row, Column $colum) => User::find($value)->name
                )
                ->collapseOnMobile(),
            Column::make("Published", "is_published")
                ->format(
                    fn($value, $row, Column $colum) => view('components.boolean-label',
                        ['value' => $value ? 'Yes' : 'No', 'color' => $value ? 'r_green-100' : 'red-500' ])
                )
                ->collapseOnMobile(),
            Column::make("Added", "updated_at")
                ->sortable()
                ->collapseOnMobile(),
            Column::make("")
                ->label(
                    fn($row, Column $column) =>
                    view('components.blog-editor-table-action-buttons',
                        ['post' => $row ])
                ),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Published', 'is_published')
                ->options([
                    '' => 'All',
                    '1' => 'Yes',
                    '0' => 'No',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 1) {
                        $builder->where('is_published', true);
                    } elseif ($value == 0) {
                        $builder->where('is_published', false);
                    }
                }),
        ];
    }
}
