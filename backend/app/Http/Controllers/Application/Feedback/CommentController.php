<?php

namespace App\Http\Controllers\Application\Feedback;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\FeedbackCommentRequest;
use App\Models\TrApplication;
use App\Models\TrFeedback;
use App\Models\TrFeedbackComment;
use Auth;

class CommentController extends Controller
{
    public function store(TrFeedback $trFeedback, FeedbackCommentRequest $feedbackCommentRequest, TrFeedbackComment $trFeedbackComment)
    {
        tap($trFeedback->tr_feedback_comments()->make($feedbackCommentRequest->validated()), function ($trFeedbackComment) {
            $trFeedbackComment->comment_tr_user_id = Auth::id();
            $trFeedbackComment->save();
        });

        return redirect()
            ->route('feedback.comment.complete')
            ->with('tr_feedback_id', $trFeedback->id);
    }

    public function complete()
    {
        $trFeedback = TrFeedback::find(session('tr_feedback_id'));
        return view('application.feedback.comment_complete', compact('trFeedback'));
    }


}
