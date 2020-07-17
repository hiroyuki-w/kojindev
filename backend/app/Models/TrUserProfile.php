<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TrUserProfile
 *
 * @property int $tr_user_id
 * @property string $user_profile
 * @property string $user_skillset
 * @property string $git_account
 * @property string $twitter_account
 * @property string $my_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TrUser $tr_user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereGitUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereLeavedFlg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereTrUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereTwitterUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereUserProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrUserProfile whereUserSkillset($value)
 * @mixin \Eloquent
 */
class TrUserProfile extends Model
{
    protected $table = 'tr_user_profiles';
    protected $primaryKey = 'tr_user_id';
    public $incrementing = false;


    protected $fillable = [
        'tr_user_id',
        'user_profile',
        'user_skillset',
        'git_account',
        'twitter_account',
        'my_url',
    ];

    public function tr_user(): BelongsTo
    {
        return $this->belongsTo(TrUser::class, 'tr_user_id');
    }
}
