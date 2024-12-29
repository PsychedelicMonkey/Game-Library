<?php

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;

use function Pest\Livewire\livewire;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

test('can render page', function () {
    $this->get(UserResource::getUrl('index'))
        ->assertSuccessful();
});

test('can list users', function () {
    $users = User::factory()->count(10)->create();

    livewire(UserResource\Pages\ListUsers::class)
        ->assertCanSeeTableRecords($users);
});

describe('create users', function () {
    test('can render page', function () {
        $this->get(UserResource::getUrl('create'))
            ->assertSuccessful();
    });

    test('can create', function () {
        $newData = User::factory()->make();

        livewire(UserResource\Pages\CreateUser::class)
            ->fillForm([
                'name' => $newData->name,
                'email' => $newData->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(User::class, [
            'name' => $newData->name,
            'email' => $newData->email,
            'email_verified_at' => null,
        ]);
    });

    test('can validate input', function () {
        livewire(UserResource\Pages\CreateUser::class)
            ->fillForm([
                'name' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required']);
    });
});

describe('edit users', function () {
    test('can render page', function () {
        $this->get(UserResource::getUrl('edit', [
            'record' => User::factory()->create(),
        ]))->assertSuccessful();
    });

    test('can retrieve data', function () {
        $user = User::factory()->create();

        livewire(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->assertFormSet([
                'name' => $user->name,
                'email' => $user->email,
            ]);
    });

    test('can save', function () {
        $user = User::factory()->create();
        $newData = User::factory()->make();

        livewire(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->fillForm([
                'name' => $newData->name,
                'email' => $newData->email,
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->expect($user->refresh())
            ->name->toBe($newData->name)
            ->email->toBe($newData->email);
    });

    test('can validate input', function () {
        $user = User::factory()->create();

        livewire(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->fillForm([
                'name' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['name' => 'required']);
    });

    test('can delete', function () {
        $user = User::factory()->create();

        livewire(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($user);
    });
});
