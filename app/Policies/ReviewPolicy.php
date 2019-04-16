<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ReviewPost;

class ReviewPolicy extends BasePolicy
{


    /**
     * Determine whether the user can view the review teacher.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewPost  $reviewTeacher
     * @return mixed
     */
    public function view(User $user, ReviewTeacher $reviewTeacher)
    {
        //
    }

    /**
     * Determine whether the user can create review teachers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the review teacher.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewPost  $reviewTeacher
     * @return mixed
     */
    public function update(User $user, ReviewTeacher $reviewTeacher)
    {
        //
    }

    /**
     * Determine whether the user can delete the review teacher.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewPost  $reviewTeacher
     * @return mixed
     */
    public function delete(User $user, ReviewTeacher $reviewTeacher)
    {
        return $user->id === $reviewTeacher->user_id;
    }

    /**
     * Determine whether the user can restore the review teacher.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewPost  $reviewTeacher
     * @return mixed
     */
    public function restore(User $user, ReviewTeacher $reviewTeacher)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the review teacher.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewPost  $reviewTeacher
     * @return mixed
     */
    public function forceDelete(User $user, ReviewTeacher $reviewTeacher)
    {
        //
    }
}
