<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TrApplicationReportRepository;
use App\Repositories\TrApplicationRepository;

class TopController extends Controller
{

    /**
     * @var TrApplicationRepository
     */
    private TrApplicationRepository $trApplicationRepository;
    /**
     * @var TrApplicationReportRepository
     */
    private TrApplicationReportRepository $trApplicationReportRepository;

    public function __construct(
        TrApplicationRepository $trApplicationRepository,
        TrApplicationReportRepository $trApplicationReportRepository
    ) {
        $this->trApplicationRepository = $trApplicationRepository;
        $this->trApplicationReportRepository = $trApplicationReportRepository;
    }

    //
    public function index()
    {
        $latestApplications = $this->trApplicationRepository->getPublishedApplicationList(6);
        //TODO:機能除却予定
        //$latestReports = $this->trApplicationReportRepository->getPublishedReportList(6);

        return view('top',
            compact('latestApplications',));
    }
}
