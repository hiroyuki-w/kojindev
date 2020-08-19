<?php

namespace App\Http\Controllers\Application\Feedback;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\FeedbackRequest;
use App\Models\TrApplication;
use App\Models\TrFeedback;
use App\Repositories\TrFeedbackRepository;

class FeedbackController extends Controller
{

    public function list(TrApplication $trApplication, TrFeedbackRepository $trFeedbackRepository)
    {
        $feedbacks = $trFeedbackRepository->getListByApplicationId($trApplication->id);
        return view('application.feedback.feedbacklist', compact('trApplication', 'feedbacks'));
    }

    public function edit(TrApplication $trApplication, TrFeedback $trFeedback)
    {
        if ($trApplication->id) {
            $this->authorize('viewOwner', $trApplication);
        }
        return view('application.feedback.edit', compact('trApplication', 'trFeedback'));
    }

    public function store(TrApplication $trApplication, TrFeedback $trFeedback, FeedbackRequest $request)
    {
        if ($trApplication->id) {
            $this->authorize('viewOwner', $trApplication);
        }

        $trApplication->tr_feedbacks()->updateOrCreate(
            ['tr_application_id' => $trApplication->id, 'id' => $trFeedback->id],
            $request->validated());
        return redirect()
            ->route('feedback.complete');
    }

    public function complete()
    {
        return view('application.feedback.feedback_complete');
    }

    public function delete(TrFeedback $trFeedback)
    {
        $this->authorize('viewOwner', $trFeedback->tr_application);

        $trFeedback->delete();
        return redirect()
            ->route('feedback.complete');
    }

    public function show(TrFeedback $trFeedback)
    {

        return view('application.feedback.show', compact('trFeedback'));
    }

    /*
        public function list(TrApplication $trApplication, TrFeedbackRepository $trFeedbackRepository)
        {
            $feedbacks = $trFeedbackRepository->getListByApplicationId($trApplication->id);
            return view('feedback.list', compact('trApplication', 'feedbacks'));
        }
    */
}
