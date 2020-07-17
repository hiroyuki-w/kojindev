<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Services\UploadImage\UploadImageService;

/**
 * Class TrUser
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $password
 * @property string $user_name
 * @property string $social_type
 * @property string $social_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TrUserProfile $tr_user_profile
 * @property Collection|TrApplicationComment[] $tr_application_comments
 * @property Collection|TrApplication[] $tr_applications
 * @package App\Models
 * @property-read int|null $tr_application_comments_count
 * @property-read int|null $tr_applications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser whereSocialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser whereSocialType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUser whereUserName($value)
 * @mixin \Eloquent
 */
class TrUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'tr_users';

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'user_name',
        'social_type',
        'social_id',
    ];

    public function tr_user_profile(): HasOne
    {
        return $this->hasOne(TrUserProfile::class);
    }

    public function tr_application_comments(): HasMany
    {
        return $this->hasMany(TrApplicationComment::class);
    }

    public function tr_applications(): HasMany
    {
        return $this->hasMany(TrApplication::class);
    }

    public function getProfileImageAttribute(): string
    {
        $images = app(UploadImageService::class)->set('ProfileIcon')->getSavedImages($this->id);
        return $images['main'][1];
    }
}
