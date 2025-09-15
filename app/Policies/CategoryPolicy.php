<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
//         $has_permissions = $user->permissions()->where('routes','categories.index')->first();
//
//         return $has_permissions ? true : false;
    }


    public function view(User $user, Category $category): bool
    {
        return '';
    }

    public function create(User $user): bool
    {
        $has_permissions = $user->permissions()->where('routes','categories.create')->first();

        return $has_permissions? true : false;

    }

    public function update(User $user, Category $category): bool
    {
        return  '';
    }


    public function delete(User $user, Category $category): bool
    {
        return  '';
    }

    public function restore(User $user, Category $category): bool
    {
        return '';
    }

    public function forceDelete(User $user, Category $category): bool
    {
        return '';
    }
}
