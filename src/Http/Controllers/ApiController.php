<?php

namespace TypiCMS\Modules\Tags\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Tags\Models\Tag;
use TypiCMS\Modules\Tags\Repositories\TagInterface as Repository;
use DB;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }


    /**
     * Get all models
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($builder = null)
    {
        $builder = $this->repository->getModel()->toBase();
        $builder->select('tags.*');
        $builder->addSelect(DB::raw('count('.DB::getTablePrefix().'taggables.id) as uses'));
        $builder->leftJoin('taggables', function($join)
        {
            $join->on('tag_id', '=', 'tags.id');
        });
        $builder->groupBy('tag');

        return parent::index($builder);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $model = $this->repository->create(Request::all());
        $error = $model ? false : true;

        return response()->json([
            'error' => $error,
            'model' => $model,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $updated = $this->repository->update(Request::all());

        return response()->json([
            'error' => !$updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Tags\Models\Tag $tag
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tag $tag)
    {
        $deleted = $this->repository->delete($tag);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
