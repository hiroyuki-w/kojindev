<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrFeedbackComment
 *
 * @property int $id
 * @property string $feedback_comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $comment_tr_user_id
 * @property int $tr_feedback_id
 *
 * @property TrFeedback $tr_feedback
 * @property TrUser $comment_tr_user
 *
 * @package App\Models
 */
class TrFeedbackComment extends Model
{
    protected $table = 'tr_feedback_comments';


    protected $fillable = [
        'feedback_comment',
        'comment_tr_user_id',
        'tr_feedback_id'
    ];


    public function tr_feedback()
    {
        return $this->belongsTo(TrFeedback::class);
    }

    public function comment_tr_user()
    {
        return $this->belongsTo(TrUser::class, 'comment_tr_user_id');
    }
}
