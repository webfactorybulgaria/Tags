<?php

namespace TypiCMS\Modules\Tags\Repositories;

use Illuminate\Database\Eloquent\Collection;
use stdClass;
use TypiCMS\Modules\Core\Shells\Repositories\RepositoryInterface;

interface TagInterface extends RepositoryInterface
{
    /**
     * Get paginated models.
     *
     * @param int   $page  Number of models per page
     * @param int   $limit Results per page
     * @param bool  $all   get published models or all
     * @param array $with  Eager load related models
     *
     * @return stdClass Object with $items && $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, array $with = [], $all = false);

    /**
     * Get all models.
     *
     * @param bool  $all  Show published or all
     * @param array $with Eager load related models
     *
     * @return Collection
     */
    public function all(array $with = [], $all = false);

    /**
     * Find existing tags or create if they don't exist.
     *
     * @param array $tags Array of strings, each representing a tag
     *
     * @return array Array or Arrayable collection of Tag objects
     */
    public function findOrCreate(array $tags);

    /**
     * Get single model by slug.
     *
     * @param string $slug of model
     * @param array  $with
     *
     * @return object object of model information
     */
    public function bySlug($slug, array $with = []);
}
