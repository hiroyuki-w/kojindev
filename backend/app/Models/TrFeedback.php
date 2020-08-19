<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrFeedback
 *
 * @property int $id
 * @property string $feedback_title
 * @property string $question_1
 * @property string $question_2
 * @property string $question_3
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $tr_application_id
 *
 * @property TrApplication $tr_application
 * @property Collection|TrFeedbackComment[] $tr_feedback_comments
 *
 * @package App\Models
 */
class TrFeedback extends Model
{
    protected $table = 'tr_feedbacks';

    protected $fillable = [
        'feedback_title',
        'question_1',
        'question_2',
        'question_3',
        'tr_application_id'
    ];

    public function tr_application()
    {
        return $this->belongsTo(TrApplication::class);
    }

    public function tr_feedback_comments()
    {
        return $this->hasMany(TrFeedbackComment::class)->with('comment_tr_user')->orderByDesc('tr_feedback_comments.created_at');
    }

}
