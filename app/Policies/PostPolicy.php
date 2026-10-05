<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Product $product): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin() || $user->isEditor() || $this->owns($user, $product);
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin() || $this->owns($user, $product);
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    public function restoreAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function replicate(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    public function reorder(User $user): bool
    {
        return $user->isAdmin();
    }

    private function owns(User $user, Product $product): bool
    {
        return (int) $user->id === (int) $product->user_id;
    }
}
