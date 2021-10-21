<?php

namespace App\UseCases\Authors;

use App\Http\Requests\Author\CreateRequest;
use App\Http\Requests\Author\UploadFileRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthorService
{

    /**
     * @param CreateRequest $request
     * @return User
     */
    public function create(CreateRequest $request): User
    {
        return DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password ?? Str::random(8)),
                'role' => User::ROLE_AUTHOR
            ]);

            return $user;
        });

    }

    /**
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator
    {
        return User::where('role',User::ROLE_AUTHOR)->with('photos')->paginate(10);
    }

    /**
     * @param int $id
     * @param UploadFileRequest $request
     */
    public function addPhotos(int $id, UploadFileRequest $request):void
    {
        $author = User::findOrFail($id);

        if ($request->hasFile('file')) {
             $author->photos()->create([
                 'file' => $request->file->store('avatars', 'public')
             ]);
             $author->update();
        }
    }
}
