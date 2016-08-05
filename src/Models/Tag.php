<?php

namespace TypiCMS\Modules\Tags\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Custom\Models\Base;
use TypiCMS\Modules\History\Custom\Traits\Historable;

class Tag extends Base
{
    use Historable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Tags\Custom\Presenters\ModulePresenter';

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
        return $this->morphedByMany('TypiCMS\Modules\Projects\Custom\Models\Project', 'taggable');
    }
}
