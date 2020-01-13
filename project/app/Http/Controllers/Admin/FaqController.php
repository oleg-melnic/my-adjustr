<?php

namespace App\Http\Controllers\Admin;

use App\Services\FaqCategoryService;
use App\Services\FaqService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * @var FaqService
     */
    private $service;

    /**
     * @var FaqCategoryService
     */
    private $categoryService;

    public function __construct(FaqService $service, FaqCategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.faq.index', ['data' => $this->service->getList()]);
    }

    public function createForm()
    {
        return view('admin.faq.create', ['categories' => $this->categoryService->getList()]);
    }

    /**
     * @param int $questionId
     *
     * @return Factory|View
     */
    public function edit($questionId)
    {
        return view('admin.faq.edit', [
            'item' => $this->service->get($questionId),
            'categories' => $this->categoryService->getList(),
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

        return redirect()->route('faq-management');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->service->update($request);

        return redirect()->route('faq-management');
    }

    public function delete(Request $request)
    {
        vred($request->all());
    }
}
