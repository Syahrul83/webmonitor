<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\WebDate;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\WebDateResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WebDateResource\RelationManagers;

class WebDateResource extends Resource
{
    protected static ?string $model = WebDate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('refresh')
                ->requiresConfirmation()
                ->label('Refresh')
                ->icon('heroicon-m-arrow-path')
                ->color('info')
                ->successNotification(
                    Notification::make()
                         ->success()
                         ->title('Data Refresh'),
                )
                 ->action(
                     function (Model $record) {
                         $post = WebDate::findOrFail($record->id);
                         $akhir = Carbon::parse($record->tanggal)->addYear();
                         return  $post->update([
                                     'tanggal' =>  $akhir ,

                                     // Update other fields as needed
                                 ]);
                     }
                 )
               ,
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
                 ->successNotificationTitle('web deleted')
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
            'index' => Pages\ListWebDates::route('/'),
            // 'create' => Pages\CreateWebDate::route('/create'),
            // 'edit' => Pages\EditWebDate::route('/{record}/edit'),
        ];
    }
}
