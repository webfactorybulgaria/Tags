<?php

namespace TypiCMS\Modules\Tags\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Shells\Models\Base;
use TypiCMS\Modules\History\Shells\Traits\Historable;

class Tag extends Base
{
    use Historable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Tags\Shells\Presenters\ModulePresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag',
        'slug',
    ];

    protected $appends = [];

    /**
     * The default route for back office.
     *
     * @var string
     */
    protected $route = 'tags';

    /**
     * Define a many-to-many polymorphic relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function projects()
    {
        return $this->morphedByMany('TypiCMS\Modules\Projects\Shells\Models\Project', 'taggable');
    }
}
