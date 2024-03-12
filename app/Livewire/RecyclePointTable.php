<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RecyclePoint;

class RecyclePointTable extends DataTableComponent
{
    // Display only owned recycle points
    public function builder(): Builder
    {
        return RecyclePoint::query()
            ->where('team_id', auth()->user()->currentTeam->id)
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageVisibilityDisabled();
        $this->setDefaultPerPage(10);
        $this->setPaginationEnabled();
        $this->setColumnSelectStatus(false);
        $this->setEmptyMessage('No recycle centres found');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Address", "address"),
            Column::make("Website", "website")
                ->format(
                    fn($value, $row, Column $colum) =>
                        view('components.table-button',
                        ['label' => 'Open URL', 'url' => $value, 'icon' => 'open', 'open_new_tab' => 'true', 'colorClasses' => 'bg-white text-gray-900 hover:bg-gray-100'])
                ),
            Column::make("Managed By", "managed_by")
                ->sortable(),
            Column::make("")
                ->label(
                    fn($row, Column $column) =>
                        view('components.recycle-point-table-action-buttons',
                        ['row' => $row])
                ),
        ];
    }
}
