<?php

namespace App\UseCases\Tags;

use App\Http\Requests\Tags\CreateRequest;
use App\Models\Tag;

class TagsService
{
    /**
     * @param CreateRequest $request
     * @return Tag
     */
    public function create(CreateRequest $request): Tag
    {
        $tag = Tag::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? null
        ]);

        return $tag;
    }
}
