<?php

namespace App\Http\Controllers;

use App\Models\TrUser;
use App\Repositories\TrApplicationReportRepository;
use App\Repositories\TrApplicationRepository;
use App\Services\ApplicationImageService;

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

    public function __construct(
        TrApplicationRepository $trApplicationRepository,
        TrApplicationReportRepository $trApplicationReportRepository
    ) {
        $this->trApplicationRepository = $trApplicationRepository;
        $this->trApplicationReportRepository = $trApplicationReportRepository;

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

        $applicationReports =
            $this->trApplicationReportRepository
                ->getListByApplicationIds($applications->pluck('id')->toArray());

        return view('user.detail',
            compact(
                'trUser', 'applications', 'applicationReports'
            ));
    }
}
