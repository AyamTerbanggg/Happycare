<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourismResource\Pages;
use App\Filament\Resources\TourismResource\RelationManagers;
use App\Models\Tourism;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TourismResource extends Resource
{
    protected static ?string $model = Tourism::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                TextInput::make('category')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->directory('tourism-images')
                    ->nullable(),
                FileUpload::make('gallery')
                    ->image()
                    ->multiple()
                    ->directory('tourism-gallery')
                    ->nullable(),
                TextInput::make('rating')
                    ->numeric()
                    ->nullable()
                    ->step(0.1)
                    ->minValue(0)
                    ->maxValue(5),
                TextInput::make('total_reviews')
                    ->numeric()
                    ->default(0)
                    ->nullable()
                    ->hiddenOn('create'),
                TextInput::make('entrance_fee')
                    ->numeric()
                    ->nullable()
                    ->prefix('Rp'),
                TextInput::make('opening_hours_start')
                    ->maxLength(255)
                    ->nullable(),
                TextInput::make('opening_hours_end')
                    ->maxLength(255)
                    ->nullable(),
                TagsInput::make('facilities')
                    ->nullable()
                    ->placeholder('Tambah fasilitas')
                    ->separator(','),
                TextInput::make('latitude')
                    ->numeric()
                    ->nullable()
                    ->step(0.00000001)
                    ->extraAttributes(['placeholder' => '-7.7956']),
                TextInput::make('longitude')
                    ->numeric()
                    ->nullable()
                    ->step(0.00000001)
                    ->extraAttributes(['placeholder' => '110.3695']),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('entrance_fee')
                    ->numeric()
                    ->prefix('Rp ')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListTourisms::route('/'),
            'create' => Pages\CreateTourism::route('/create'),
            'edit' => Pages\EditTourism::route('/{record}/edit'),
        ];
    }    
}
