<?php

namespace App\Http\Controllers;

use App\Models\TrUser;
use App\Repositories\TrApplicationReportRepository;
use App\Repositories\TrApplicationRepository;
use App\Repositories\TrFeedbackRepository;
use App\Repositories\TrUserRepository;
use App\Services\ApplicationImageService;
use App\Services\Twitter\GetTweetService;

class UserController extends Controller
{


    /**
     * @var TrApplicationRepository
     */
    private TrApplicationRepository $trApplicationRepository;
    /**
     * @var TrApplicationReportRepository
     */
    private trApplicationReportRepository $trApplicationReportRepository;
    /**
     * @var GetTweetService
     */
    private GetTweetService $getTweetService;

    public function __construct(
        TrApplicationRepository $trApplicationRepository,
        TrApplicationReportRepository $trApplicationReportRepository,
        GetTweetService $getTweetService,
        TrFeedbackRepository $feedbackRepository
    )
    {
        $this->trApplicationRepository = $trApplicationRepository;
        $this->trApplicationReportRepository = $trApplicationReportRepository;
        $this->getTweetService = $getTweetService;
        $this->feedbackRepository = $feedbackRepository;

    }

    public function detail(trUser $trUser)
    {
        $applications = $this->trApplicationRepository->getListByTrUserId($trUser->id);

        //所有者外のアクセスは公開済みのみで絞る
        if ($trUser->can('owner') === false) {
            $applications = $applications->filter(function ($application) {
                return $application->public_flg == FLG_ON;
            });
        }
        $feedbacksHash = $this->feedbackRepository->getListByApplicationIds($applications->pluck('id')->toArray(), 2);
        $applicationReports = $this->getTweetService->getApplicationTweetMany($trUser->tr_user_profile, $applications, 10);

        return view('user.detail',
            compact(
                'trUser', 'applications', 'applicationReports', 'feedbacksHash'
            ));
    }

    public function search($keyword = '', TrUserRepository $trUserRepository)
    {
        $trUsers = $trUserRepository->search($keyword, 20);
        return view('user.search', compact('trUsers', 'keyword'));
    }
}
