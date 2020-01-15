<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Admin\Controller;
use App\Services\Blog\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $service;

    /**
     * CategoryController constructor.
     * 
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.blog.category.index', ['data' => $this->service->getList()]);
    }

    /**
     * @return Factory|View
     */
    public function createForm()
    {
        return view('admin.blog.category.create');
    }

    /**
     * @param int $categoryId
     *
     * @return Factory|View
     */
    public function edit($categoryId)
    {
        return view('admin.blog.category.edit', ['item' => $this->service->get($categoryId)]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $this->service->create($request);

        return redirect()->route('blog-category-management');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->service->update($request);

        return redirect()->route('blog-category-management');
    }

    public function delete(Request $request)
    {
        vred($request->all());
    }
}
