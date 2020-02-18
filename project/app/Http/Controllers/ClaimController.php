<?php

namespace App\Http\Controllers;

use App\Services\Claim\ClaimService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClaimController extends Controller
{
    /**
     * @var ClaimService
     */
    private $service;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(ClaimService $service, UserService $userService)
    {
        $this->service = $service;
        $this->userService = $userService;
    }

    public function index()
    {
        return view('claims.index', [
            'data' => $this->service->getList(),
            'professionals' => $this->userService->getListByType(UserService::TYPE_PROFESSIONAL),
        ]);
    }

    public function createForm()
    {
        return view('claims.create');
    }

    /**
     * @param int $itemId
     *
     * @return Factory|View
     */
    public function edit($itemId)
    {
        return view('claims.edit', [
            'item' => $this->service->get($itemId),
            'professionals' => $this->userService->getListByType(UserService::TYPE_PROFESSIONAL),
        ]);
    }

    /**
     * @param int $itemId
     *
     * @return Factory|View
     */
    public function show($itemId)
    {
        return view('claims.show', [
            'item' => $this->service->get($itemId),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $this->service->create($request);

        return redirect()->route('home');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->service->update($request);

        return redirect()->route('home');
    }

    public function delete(Request $request)
    {
        vred($request->all());
    }
}
