<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\ApplicationCommentRequest;
use App\Models\TrApplication;
use App\Models\TrApplicationComment;
use Auth;
use App\Http\Controllers\Controller as Controller;

class CommentController extends Controller
{
    /**
     * @var TrApplicationComment
     */
    private TrApplicationComment $trApplicationComment;

    public function __construct(TrApplicationComment $trApplicationComment)
    {
        $this->trApplicationComment = $trApplicationComment;
    }

    public function store(TrApplication $trApplication, ApplicationCommentRequest $request)
    {
        tap($trApplication->tr_application_comments()->make($request->validated()), function ($trApplicationComment) {
            $trApplicationComment->tr_user_id = Auth::id();
            $trApplicationComment->user_name = Auth::user()->user_name;
            $trApplicationComment->save();
        });

        return redirect()
            ->route('application.comment.complete')
            ->with('tr_application_id', $trApplication->id);
    }

    public function complete()
    {
        return view('application.comment_complete');
    }
}
