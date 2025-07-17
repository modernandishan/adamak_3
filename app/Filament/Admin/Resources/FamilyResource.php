<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FamilyResource\Pages;
use App\Filament\Admin\Resources\FamilyResource\RelationManagers;
use App\Models\Family;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getModelLabel(): string
    {
        return 'خانواده';
    }

    public static function getPluralModelLabel(): string
    {
        return 'خانواده‌ها';
    }

    public static function getNavigationLabel(): string
    {
        return 'خانواده‌ها';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('عنوان')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('father_name')
                    ->maxLength(255)
                    ->label('نام پدر'),

                Forms\Components\TextInput::make('mother_name')
                    ->maxLength(255)
                    ->label('نام مادر'),

                Forms\Components\Toggle::make('is_father_gone')
                    ->required()
                    ->label('پدر فوت کرده است'),

                Forms\Components\Toggle::make('is_mother_gone')
                    ->required()
                    ->label('مادر فوت کرده است'),

                Forms\Components\Repeater::make('members')
                    ->schema([
                        Forms\Components\TextInput::make('role')
                            ->required()
                            ->label('نقش در خانواده'),
                        Forms\Components\TextInput::make('age')
                            ->required()
                            ->numeric()
                            ->label('سن'),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'male' => 'مرد',
                                'female' => 'زن',
                            ])
                            ->required()
                            ->label('جنسیت'),
                    ])
                    ->columnSpanFull()
                    ->label('اعضای خانواده')
                    ->minItems(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->label('کاربر'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('عنوان'),
                Tables\Columns\TextColumn::make('father_name')
                    ->searchable()
                    ->label('نام پدر'),
                Tables\Columns\TextColumn::make('mother_name')
                    ->searchable()
                    ->label('نام مادر'),
                Tables\Columns\IconColumn::make('is_father_gone')
                    ->boolean()
                    ->label('فوت پدر'),
                Tables\Columns\IconColumn::make('is_mother_gone')
                    ->boolean()
                    ->label('فوت مادر'),
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
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
