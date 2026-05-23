<?php

if (!function_exists('storage_public_url')) {
    /**
     * Public URL for a file on the "public" disk (relative to current host).
     */
    function storage_public_url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return '/storage/' . ltrim($path, '/');
    }
}
