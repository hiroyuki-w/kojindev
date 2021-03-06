<?php

namespace App\Http\Controllers\Application;

use App\Repositories\TrApplicationRepository;
use App\Repositories\TrFeedbackRepository;
use App\Services\ApplicationService;
use App\Services\Twitter\GetTweetService as GetTweetService;
use Auth;
use App\Models\TrApplication;
use App\Repositories\TrApplicationReportRepository;
use App\Repositories\TrApplicationTagRepository;
use App\Repositories\TrApplicationCommentRepository;
use App\Http\Requests\ApplicationRequest;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Collection;
use App\Services\UploadImage\UploadImageService;

class ApplicationController extends Controller
{
    /**
     * @var TrApplicationReportRepository
     */
    private TrApplicationReportRepository $trApplicationReportRepository;
    /**
     * @var TrApplicationCommentRepository
     */
    private TrApplicationCommentRepository $trApplicationCommentRepository;
    /**
     * @var TrApplicationTagRepository
     */
    private TrApplicationTagRepository $trApplicationTagRepository;
    /**
     * @var UploadImageService
     */
    private UploadImageService $uploadImageService;
    /**
     * @var ApplicationService
     */
    private ApplicationService $applicationService;
    /**
     * @var TrFeedbackRepository
     */
    private TrFeedbackRepository $trFeedbackRepository;

    public function __construct(
        trApplicationCommentRepository $trApplicationCommentRepository,
        TrApplicationReportRepository $trApplicationReportRepository,
        TrApplicationTagRepository $trApplicationTagRepository,
        UploadImageService $uploadImageService,
        ApplicationService $applicationService,
        GetTweetService $getTweetService,
        TrFeedbackRepository $trFeedbackRepository

    )
    {
        $this->trApplicationReportRepository = $trApplicationReportRepository;
        $this->trApplicationCommentRepository = $trApplicationCommentRepository;
        $this->trApplicationTagRepository = $trApplicationTagRepository;
        $this->uploadImageService = $uploadImageService;
        $this->applicationService = $applicationService;
        $this->getTweetService = $getTweetService;
        $this->trFeedbackRepository = $trFeedbackRepository;

    }

    public function show(TrApplication $trApplication)
    {
        $this->authorize('published', $trApplication);

        $reports = $this->getTweetService->getApplicationTweet($trApplication->tr_user->tr_user_profile, $trApplication, 10);
        $feedbacks = $this->trFeedbackRepository->getListByApplicationId($trApplication->id);
        $comments = $this->trApplicationCommentRepository->getListByApplicationId($trApplication->id, 10);

        return view('application.show',
            compact('trApplication', 'reports', 'feedbacks', 'comments')
        );
    }

    public function create()
    {
        $trApplication = new TrApplication;
        return view('application.create', compact('trApplication'));
    }

    public function edit(TrApplication $trApplication)
    {
        $this->authorize('viewOwner', $trApplication);

        return view('application.create', compact('trApplication'));
    }

    public function store(TrApplication $trApplication, ApplicationRequest $request)
    {
        if ($trApplication->id) {
            $this->authorize('viewOwner', $trApplication);
        }
        $this->applicationService->saveApplication($request->validated(), $request->user(), $trApplication);

        return redirect()
            ->route('application.complete')
            ->with('tr_application_id', 1);
    }

    public function complete()
    {
        return view('application.complete');
    }

    public function togglePublicFlg(TrApplication $trApplication)
    {
        $this->authorize('viewOwner', $trApplication);

        $trApplication->update(
            ['public_flg' => ($trApplication->public_flg ? 0 : 1)]
        );

        return redirect()
            ->route('user.detail', ['trUser' => Auth::id()]);
    }

    public function delete(TrApplication $trApplication)
    {
        $this->authorize('viewOwner', $trApplication);

        $trApplication->delete();

        return redirect()
            ->route('user.detail', ['trUser' => Auth::id()]);
    }

    public function search($tag = '', TrApplicationRepository $trApplicationRepository)
    {
        $trApplications = $trApplicationRepository->search($tag, 20);
        return view('application.search', compact('trApplications', 'tag'));
    }
}
