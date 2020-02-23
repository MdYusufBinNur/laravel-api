<?php


namespace App\Repositories\Contracts;


interface PostRepository extends BaseRepository
{
    /**
     * get the user info of the users who liked
     *
     * @param int $postId
     * @return mixed
     */
    public function likedUsersByPostId(int $postId);
}
