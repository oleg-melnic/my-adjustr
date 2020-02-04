<?php

namespace App\Http\Controllers;

use App\Services\ClaimService;

class HomeController extends Controller
{
    /** @var ClaimService */
    private $claimService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClaimService $claimService)
    {
        $this->middleware('auth');
        $this->claimService = $claimService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard', ['data' => $this->claimService->getList()]);
    }
}
