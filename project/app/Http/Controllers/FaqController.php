<?php

namespace App\Http\Controllers;

use App\Services\FaqCategoryService;
use App\Services\FaqService;

class FaqController extends Controller
{
    /**
     * @var FaqService
     */
    private $service;

    /**
     * @var Category
     */
    private $catService;

    public function __construct(FaqService $service, FaqCategoryService $catService)
    {
        $this->service = $service;
        $this->catService = $catService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('faq/index', [
            'catList' => $this->service->getList()
        ]);
    }

    /**
     * @param string $alias
     *
     * @return \Illuminate\View\View
     */
    public function category(string $alias)
    {
        $category = $this->catService->getByAlias($alias);
        return view('faq/category', [
            'category' => $category,
            'questions' => $this->service->getByCategory($category),
        ]);
    }
}
