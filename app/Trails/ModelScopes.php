<?php
namespace App\Trails;

/**
 * summary
 */
trait ModelScopes
{
    /**
     * summary
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrder($query)
    {
    	return $query->orderBy('created_at', 'DESC');
    }
}
