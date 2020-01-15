<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\Controller as AbstractController;
use App\Services\Blog\CategoryService;
use App\Services\Blog\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Controller extends AbstractController
{
    /**
     * @var Service
     */
    private $service;

    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(Service $service, CategoryService $categoryService)
    {
        $this->service = $service;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.blog.index', ['data' => $this->service->getList()]);
    }

    public function createForm()
    {
        return view('admin.blog.create', ['categories' => $this->categoryService->getList()]);
    }

    /**
     * @param int $itemId
     *
     * @return Factory|View
     */
    public function edit($itemId)
    {
        return view('admin.blog.edit', [
            'item' => $this->service->get($itemId),
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

        return redirect()->route('blog-management');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->service->update($request);

        return redirect()->route('blog-management');
    }

    public function delete(Request $request)
    {
        vred($request->all());
    }
}
