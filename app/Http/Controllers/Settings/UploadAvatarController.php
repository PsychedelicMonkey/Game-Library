<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class UploadAvatarController extends Controller
{
    /**
     * Upload the user's avatar.
     *
     * @throws ValidationException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'image'],
            'caption' => ['nullable', 'string', 'max:255'],
        ]);

        /** @var User $user */
        $user = $request->user();

        try {
            $user->profile->addMediaFromRequest('file')
                ->withCustomProperties([
                    'caption' => $request->string('caption'),
                ])
                ->toMediaCollection('profile-avatars');
        } catch (FileDoesNotExist $e) {
            throw ValidationException::withMessages([
                'file' => __('File does not exist'),
            ]);
        } catch (FileIsTooBig $e) {
            throw ValidationException::withMessages([
                'file' => __('File is too big'),
            ]);
        }

        return back();
    }
}
