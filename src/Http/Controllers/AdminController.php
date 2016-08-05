<?php

namespace TypiCMS\Modules\Tags\Http\Controllers;

use TypiCMS\Modules\Core\Custom\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Tags\Custom\Http\Requests\FormRequest;
use TypiCMS\Modules\Tags\Custom\Models\Tag;
use TypiCMS\Modules\Tags\Custom\Repositories\TagInterface;

class AdminController extends BaseAdminController
{
    public function __construct(TagInterface $tag)
    {
        parent::__construct($tag);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('tags::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('tags::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Tags\Custom\Models\Tag $tag
     *
     * @return \Illuminate\View\View
     */
    public function edit(Tag $tag)
    {
        return view('tags::admin.edit')
            ->with(['model' => $tag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Tags\Custom\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $tag = $this->repository->create($request->all());

        return $this->redirect($request, $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Tags\Custom\Models\Tag                $model
     * @param \TypiCMS\Modules\Tags\Custom\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tag $tag, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $tag);
    }
}
