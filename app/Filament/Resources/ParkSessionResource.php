<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParkSessionResource\Pages;
use App\Filament\Resources\ParkSessionResource\RelationManagers;
use App\Models\ParkSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParkSessionResource extends Resource
{
    protected static ?string $model = ParkSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('disk_id')
                    ->relationship('disk', 'id'),
                Forms\Components\DateTimePicker::make('started_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('ended_at')
                    ->required(),
                Forms\Components\TextInput::make('address_id')
                    ->numeric(),
                Forms\Components\Toggle::make('is_current')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('disk.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_current')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParkSessions::route('/'),
            'create' => Pages\CreateParkSession::route('/create'),
            'edit' => Pages\EditParkSession::route('/{record}/edit'),
        ];
    }
}
