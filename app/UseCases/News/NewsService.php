<?php

namespace App\UseCases\News;

use App\Http\Requests\News\CreateRequest;
use App\Models\Author;
use App\Models\News;
use App\Models\NewsTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NewsService
{

    public function create(CreateRequest $request): News
    {
        $author = User::findOrFail($request->author_id);
        $tags = null;

        if ($request->tags) {
            $tags = Tag::whereIn('id', $request->tags)
                ->orderByRaw(\DB::raw("FIELD(id, " . implode(",", $request->tags) . ")"
                ))->get();
        }

        return DB::transaction(function () use ($request, $author, $tags) {

            $news = News::create([
                'title' => $request->title,
                'anons' => $request->anons,
                'text' => $request->text,
                'published_at' => Carbon::now(),
            ]);

            $news->author()->associate($author);

            $news->saveOrFail();

            if (!is_null($tags)) {
                foreach ($tags as $tag) {
                    NewsTag::create([
                        'news_id' => $news->id,
                        'tag_id' => $tag->id
                    ]);
                }
            }


            return $news;
        });
    }

    /**
     * @param int $authorId
     * @return User
     */
    public function getByAuthor(int $authorId): ?LengthAwarePaginator
    {
        return User::with('news')
                ->where('id',$authorId)
                ->paginate(10);
    }

    /**
     * @param int $tagId
     * @return NewsTag
     */
    public function getByTag(int $tagId): ?LengthAwarePaginator
    {
        $news = NewsTag::with('news')->where('tag_id',$tagId)->paginate(10);

        return $news;
    }

    public function getById(int $id): News
    {
        return News::findOrFail($id);
    }

}
