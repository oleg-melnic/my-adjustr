<?php

namespace App\Http\Controllers\Admin;

use App\Services\FaqCategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqCategoryController extends Controller
{
    /**
     * @var FaqCategoryService
     */
    private $service;

    /**
     * FaqCategoryController constructor.
     * @param FaqCategoryService $service
     */
    public function __construct(FaqCategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.faq.category.index', ['data' => $this->service->getList()]);
    }

    /**
     * @return Factory|View
     */
    public function createForm()
    {
        return view('admin.faq.category.create');
    }

    /**
     * @param int $categoryId
     *
     * @return Factory|View
     */
    public function edit($categoryId)
    {
        return view('admin.faq.category.edit', ['item' => $this->service->get($categoryId)]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $this->service->create($request);

        return redirect()->route('faq-category-management');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->service->update($request);

        return redirect()->route('faq-category-management');
    }

    public function delete(Request $request)
    {
        vred($request->all());
    }
}
