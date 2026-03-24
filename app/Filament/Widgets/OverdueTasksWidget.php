<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Carbon\Carbon;

class OverdueTasksWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Task::query()
                    ->where('status', '!=', 'completed')
                    ->where('due_date', '<', Carbon::today())
                    ->latest('due_date')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedUser.name')
                    ->label('Assigned To')
                    ->numeric()
                    ->sortable()
                    ->default('—'),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable()
                    ->color('danger'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info'    => 'in_progress',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'pending'     => 'Pending',
                        'in_progress' => 'In Progress',
                        default       => $state,
                    }),
            ])
            ->paginated([5]);
    }
}
