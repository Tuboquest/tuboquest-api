<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiskResource\Pages;
use App\Filament\Resources\DiskResource\RelationManagers;
use App\Models\Disk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DiskResource extends Resource
{
    protected static ?int $navigationSort = 2;
    
    protected static ?string $model = Disk::class;

    protected static ?string $navigationGroup = 'Disks';

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'firstname'),
                Forms\Components\TextInput::make('pairing_code')
                    ->maxLength(4)
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('host')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('token')
                        ->password()
                        ->revealable()
                        ->required()
                        ->disabled()
                        ->columnSpan(12),
                ])
                    ->columns(12)
                    ->visibleOn('edit')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('host')
                    ->searchable(),
                Tables\Columns\TextColumn::make('battery')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('serial_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pairing_code')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_paired')
                    ->boolean(),
                Tables\Columns\TextColumn::make('user.firstname')
                    ->searchable()
                    ->label('User')
                    ->default('')
                    ->formatStateUsing(function ($state, Disk $disk) {
                        if ($disk->user === null) {
                            return 'Unpaired';
                        }
                        return $disk->user->firstname . ' ' . $disk->user->lastname;
                    }),
                Tables\Columns\TextColumn::make('angle')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListDisks::route('/'),
            'create' => Pages\CreateDisk::route('/create'),
            'edit' => Pages\EditDisk::route('/{record}/edit'),
        ];
    }
}
