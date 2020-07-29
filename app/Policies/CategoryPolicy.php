<?php

namespace App\Policies;

use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user, Category $category)
    {
        return $user->role === "admin";
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function view(User $user, Category $category)
    {
        return $user->role === "admin";
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role === "admin";
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function update(User $user, Category $category)
    {
        return $user->role === "admin";
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function delete(User $user, Category $category)
    {
        return $user->role === "admin";
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function restore(User $user, Category $category)
    {
        return $user->role === "admin";
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function forceDelete(User $user, Category $category)
    {
        return $user->role === "admin";
    }
}
