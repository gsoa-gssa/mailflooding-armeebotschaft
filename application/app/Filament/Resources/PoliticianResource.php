<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoliticianResource\Pages;
use App\Filament\Resources\PoliticianResource\RelationManagers;
use App\Models\Politician;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Support\Facades\App;

class PoliticianResource extends Resource
{
    protected static ?string $model = Politician::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Radio::make('salutation')
                    ->options([
                        'neutral' => 'Neutral',
                        'female' => 'Female',
                        'male' => 'Male'
                    ])
                    ->inline()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\Select::make('canton_id')
                    ->relationship('canton', 'name')
                    ->required(),
                Forms\Components\Select::make('faction_id')
                    ->relationship('faction', 'name')
                    ->required(),
                Forms\Components\Select::make('council_id')
                    ->relationship('council', 'name')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('canton.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('faction.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('council.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(\App\Filament\Imports\PoliticianImporter::class)
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
            'index' => Pages\ListPoliticians::route('/'),
            'create' => Pages\CreatePolitician::route('/create'),
            'edit' => Pages\EditPolitician::route('/{record}/edit'),
        ];
    }
}
