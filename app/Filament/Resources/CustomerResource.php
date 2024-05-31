<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Models\Contracts\FilamentUser;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use App\Filament\Resources\CustomerResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class CustomerResource extends Resource implements FilamentUser
{
    use HasPanelShield;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        /**
         * Form buat bikin User Customer baru
         */
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->email(),
                TextInput::make('password')
                    ->required(),
                Forms\Components\CheckboxList::make('roles')
                    ->relationship('roles', 'name')
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            /**
             * Buat munculin table user
             * **/
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('roles.name'),
                TextColumn::make('created_at')
                    ->dateTime(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
