<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

use function Illuminate\Events\queueable;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property ?CarbonInterface $email_verified_at
 * @property string $password
 * @property ?string $remember_token
 * @property Profile $profile
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class User extends Authenticatable
{
    use Billable;
    use HasApiTokens;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasUlids;
    use Notifiable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = ['avatar'];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'stripe_id' => null,
        'pm_type' => null,
        'pm_last_four' => null,
        'trial_ends_at' => null,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** @return HasOne<Profile, $this> */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * @return Attribute<mixed, mixed>
     */
    protected function avatar(): Attribute
    {
        return new Attribute(
            get: fn () => $this->profile->getAvatarUrl('icon'),
        );
    }

    protected static function booted(): void
    {
        parent::booted();

        static::created(function (User $user) {
            $user->profile()->create(['username' => $user->name]);
        });

        static::updated(queueable(function (User $customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }
}
