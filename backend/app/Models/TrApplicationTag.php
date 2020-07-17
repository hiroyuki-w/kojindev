<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TrApplicationTag
 *
 * @property int $id
 * @property int $tr_application_id
 * @property string $tag_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TrApplication $tr_application
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag whereTrServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TrApplicationTag extends Model
{
    protected $table = 'tr_application_tags';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function tr_application(): BelongsTo
    {
        return $this->belongsTo(TrApplication::class);
    }
}
