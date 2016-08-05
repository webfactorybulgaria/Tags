<?php

namespace TypiCMS\Modules\Tags\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Request;
use TypiCMS;
use TypiCMS\Modules\Core\Custom\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Tags\Custom\Repositories\TagInterface;

class PublicController extends BasePublicController
{
    public function __construct(TagInterface $tag)
    {
        parent::__construct($tag, 'tags');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $page = Request::input('page');
        $perPage = config('typicms.tags.per_page');
        $data = $this->repository->byPage($page, $perPage, []);
        $models = new Paginator($data->items, $data->totalItems, $perPage, null, ['path' => Paginator::resolveCurrentPath()]);

        return view('tags::public.index')
            ->with(compact('models'));
    }

    /**
     * Show news.
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $model = $this->repository->bySlug($slug);

        return view('tags::public.show')
            ->with(compact('model'));
    }
}
