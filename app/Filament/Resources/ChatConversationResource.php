<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatConversationResource\Pages;
use App\Filament\Resources\ChatConversationResource\RelationManagers;
use App\Models\ChatConversation;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChatConversationResource extends Resource
{
    protected static ?string $model = ChatConversation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('admin_id')
                    ->relationship('admin', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload(),
                Select::make('status')
                    ->options([
                        'open' => 'Terbuka',
                        'closed' => 'Tertutup',
                        'pending' => 'Menunggu',
                    ])
                    ->required()
                    ->default('open'),
                DateTimePicker::make('last_message_at')
                    ->nullable()
                    ->readOnly()
                    ->label('Pesan Terakhir Pada'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('admin.name')
                    ->label('Admin Ditugaskan')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Belum Ditugaskan'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'closed' => 'danger',
                        'pending' => 'warning',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('last_message_at')
                    ->label('Pesan Terakhir')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListChatConversations::route('/'),
            'create' => Pages\CreateChatConversation::route('/create'),
            'edit' => Pages\EditChatConversation::route('/{record}/edit'),
        ];
    }    
}
