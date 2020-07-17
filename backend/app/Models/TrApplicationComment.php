<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TrApplicationComment
 *
 * @property int $id
 * @property int $tr_application_id
 * @property int $tr_user_id
 * @property string $user_name
 * @property string $post_comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TrApplication $tr_application
 * @property TrUser $tr_user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment wherePostComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment wherePostDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment whereTrApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment whereTrUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationComment whereUserName($value)
 * @mixin \Eloquent
 */
class TrApplicationComment extends Model
{

    protected $table = 'tr_application_comments';

    protected $dates = [
    ];
    protected $fillable = [
        'id',
        'tr_application_id',
        'tr_user_id',
        'user_name',
        'post_comment',
    ];

    public function tr_application(): BelongsTo
    {
        return $this->belongsTo(TrApplication::class);
    }

    public function tr_user(): BelongsTo
    {
        return $this->belongsTo(TrUser::class);
    }
}
