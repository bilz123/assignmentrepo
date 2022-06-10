<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Interfaces\CategoryRespositoryInterface;
use App\Models\Category;
//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends CategoryRespositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    // public function createCategory(array $category)
    // {

    //     return Category::create($category);
    // }
}
