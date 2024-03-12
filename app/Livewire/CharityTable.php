<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Charity;

class CharityTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Charity::query()
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageVisibilityDisabled();
        $this->setDefaultPerPage(10);
        $this->setPaginationEnabled();
        $this->setColumnSelectStatus(false);
        $this->setEmptyMessage('No charities found');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Email", "email")
                ->format(
                    fn($value, $row, Column $colum) =>
                    view('components.table-button',
                        ['label' => $value, 'url' => 'mailto:'.$value, 'link' => true, 'colorClasses' => 'underline hover:text-r_orange'])
                ),
            Column::make("Website", "website")
                ->format(
                    fn($value, $row, Column $colum) =>
                    view('components.table-button',
                        ['label' => 'Open URL', 'url' => $value, 'icon' => 'open', 'open_new_tab' => 'true', 'colorClasses' => 'bg-white text-gray-900 hover:bg-gray-100'])
                ),
            Column::make("Phone", "phone"),
            Column::make("Registration ID", "charity_registration"),
            Column::make("")
                ->label(
                    fn($row, Column $column) =>
                    view('components.charity-table-action-buttons',
                        ['row' => $row ])
                ),
        ];
    }
}
