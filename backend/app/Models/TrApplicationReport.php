<?php

/**
 * //TODO:機能除却予定
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TrApplicationReport
 *
 * @property int $id
 * @property int $tr_application_id
 * @property int $report_type
 * @property string $report_title
 * @property string $report_text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TrApplication $tr_application
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport whereReportText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport whereReportTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport whereReportType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport whereTrApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrApplicationReport published(Builder $query)
 * @see TrApplicationReport::scopePublished
 */
class TrApplicationReport extends Model
{
    protected $table = 'tr_application_reports';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //コード定義
    const REPORT_TYPE_DEVELOP = 1;
    const REPORT_TYPE_RELEASE = 2;
    const REPORT_TYPE_INFO = 3;
    const REPORT_TYPE = [
        self::REPORT_TYPE_DEVELOP => ['key' => self::REPORT_TYPE_DEVELOP, 'code' => 'develop', 'name' => '開発報告'],
        self::REPORT_TYPE_RELEASE => ['key' => self::REPORT_TYPE_RELEASE, 'code' => 'release', 'name' => 'リリース報告'],
        self::REPORT_TYPE_INFO => ['key' => self::REPORT_TYPE_INFO, 'code' => 'info', 'name' => '運営報告'],
    ];


    public function tr_application(): BelongsTo
    {
        return $this->belongsTo(TrApplication::class);
    }

    /**
     * 公開OKなレポートリスト取得
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereIn('tr_application_reports.tr_application_id', function ($query) {
            $query->from('tr_applications')->select('tr_applications.id')->where('public_flg', '1');
        });
    }

    public function getReportTypeCodeAttribute(): string
    {
        return self::REPORT_TYPE[$this->report_type]['code'];

    }
}
