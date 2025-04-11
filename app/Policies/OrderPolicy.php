<?php

namespace App\Policies;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderPolicy
{
    /**
     * Determine whether the user can view any orders.
     */
    public function viewAny(User $user): bool
    {
        // Admins can view all orders
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view a specific order.
     */
    public function view(User $user, Order $order): bool
    {
        //dump($user->id);
        // Users can view their own orders or admins can view any
        return $user->id === $order->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can create an order.
     */
    public function create(User $user): bool
    {
        //dd('create : $user->id');
        // Any logged-in user can place an order
        return $user !== null;
    }

    /**
     * Determine whether the user can update an order.
     */
    public function update(User $user, Order $order): bool
    {
        // Users can update their own orders if they are still pending
        return $user->id === $order->user_id && $order->status === OrderStatus::PENDING;
    }

    /**
     * Determine whether the user can delete an order.
     */
    public function delete(User $user, Order $order): bool
    {
        // Users can delete their own pending orders

        return $user->id === $order->user_id && $order->status === OrderStatus::PENDING->value;
    }

    /**
     * Determine whether the user can restore a deleted order.
     */
    public function restore(User $user, Order $order): bool
    {
        // Allow only admin to restore
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete an order.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        // Only admins can permanently delete
        return $user->isAdmin();
    }
}
