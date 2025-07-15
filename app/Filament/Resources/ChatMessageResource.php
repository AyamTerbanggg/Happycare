<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatMessageResource\Pages;
use App\Filament\Resources\ChatMessageResource\RelationManagers;
use App\Models\ChatMessage;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChatMessageResource extends Resource
{
    protected static ?string $model = ChatMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('chat_conversation_id')
                    ->relationship('conversation', 'id') // Menampilkan ID percakapan
                    ->label('ID Percakapan')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('sender_id')
                    ->relationship('sender', 'name')
                    ->label('Pengirim')
                    ->nullable()
                    ->searchable()
                    ->preload(),
                Select::make('sender_type')
                    ->options([
                        'user' => 'Pengguna',
                        'admin' => 'Admin',
                        'bot' => 'Bot',
                    ])
                    ->required()
                    ->default('user'),
                Textarea::make('message')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                DateTimePicker::make('read_at')
                    ->label('Dibaca Pada')
                    ->nullable()
                    ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('conversation.id')
                    ->label('ID Percakapan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('sender.name')
                    ->label('Pengirim')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Bot/Guest'),
                TextColumn::make('sender_type')
                    ->label('Tipe Pengirim')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'user' => 'info',
                        'admin' => 'success',
                        'bot' => 'warning',
                    })
                    ->sortable(),
                TextColumn::make('message')
                    ->limit(50)
                    ->searchable(),
                IconColumn::make('read_at')
                    ->label('Dibaca')
                    ->boolean()
                    ->getStateUsing(fn (ChatMessage $record): bool => (bool) $record->read_at)
                    ->sortable()
                    ->tooltip(fn (ChatMessage $record): ?string => $record->read_at ? 'Dibaca pada: ' . $record->read_at->format('Y-m-d H:i:s') : 'Belum dibaca'),
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListChatMessages::route('/'),
            'create' => Pages\CreateChatMessage::route('/create'),
            'edit' => Pages\EditChatMessage::route('/{record}/edit'),
        ];
    }    
}
