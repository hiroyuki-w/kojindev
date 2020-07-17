<?php

namespace App\Models;

use App\Services\UploadImage\UploadImageService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class TrApplication
 *
 * @property int $id
 * @property int $tr_user_id
 * @property string $application_name
 * @property string $application_concept
 * @property string $application_overview
 * @property int $public_flg
 * @property int $application_type
 * @property string $used_technology
 * @property string $pr_message
 * @property string $additional_features
 * @property string $other_message
 * @property string $application_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TrUser $tr_user
 * @property Collection|TrApplicationComment[] $tr_application_comments
 * @property Collection|TrApplicationReport[] $tr_application_reports
 * @property Collection|TrApplicationTag[] $tr_application_tags
 * @package App\Models
 *
 * @method Builder published(Builder $query)
 * @see TrApplication::scopePublished
 *
 *
 */
class TrApplication extends Model
{
    protected $table = 'tr_applications';

    protected $fillable = [
        'tr_user_id',
        'application_name',
        'application_concept',
        'application_overview',
        'public_flg',
        'application_type',
        'used_technology',
        'pr_message',
        'additional_features',
        'other_message',
        'application_url',

    ];

    //コード定義
    const APPLICATION_TYPE_SPAPP = 1;
    const APPLICATION_TYPE_WEBSITE = 2;
    const APPLICATION_TYPE_OTHER = 3;
    const APPLICATION_TYPE = [
        self::APPLICATION_TYPE_SPAPP => [
            'key' => self::APPLICATION_TYPE_SPAPP, 'code' => 'spapp', 'name' => 'スマホアプリ'
        ],
        self::APPLICATION_TYPE_WEBSITE => [
            'key' => self::APPLICATION_TYPE_WEBSITE, 'code' => 'website', 'name' => 'WEBサイト'
        ],
        self::APPLICATION_TYPE_OTHER => [
            'key' => self::APPLICATION_TYPE_OTHER, 'code' => 'other', 'name' => 'その他アプリ'
        ],
    ];

    public function tr_user(): BelongsTo
    {
        return $this->belongsTo(TrUser::class);
    }

    public function tr_application_comments(): HasMany
    {
        return $this->hasMany(TrApplicationComment::class);
    }

    public function tr_application_reports(): HasMany
    {
        return $this->hasMany(TrApplicationReport::class);
    }

    public function tr_application_tags(): HasMany
    {
        return $this->hasMany(TrApplicationTag::class);
    }


    /**
     * 公開OKなサービスリスト取得
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('public_flg', FLG_ON);
    }

    public function getApplicationTypeCodeAttribute(): string
    {
        return self::APPLICATION_TYPE[$this->application_type]['code'];
    }

    public function getApplicationThumbnailsAttribute(): array
    {
        $images = app(UploadImageService::class)->set('Application')->getSavedImages($this->id);
        return $images['thum'];
    }

    public function getApplicationImagesAttribute(): array
    {
        $images = app(UploadImageService::class)->set('Application')->getSavedImages($this->id);
        return $images['main'];
    }

}
