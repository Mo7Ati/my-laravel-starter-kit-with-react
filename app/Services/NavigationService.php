<?php

namespace App\Services;

class NavigationService
{
    /**
     * Get navigation items based on panel type
     *
     * @param string $panel
     * @return array
     */
    public function getNavigationItems(string $panel): array
    {
        return match ($panel) {
            'admin' => $this->getAdminNavigationItems(),
            'store' => $this->getStoreNavigationItems(),
            default => $this->getDefaultNavigationItems(),
        };
    }

    /**
     * Get admin panel navigation items
     *
     * @return array
     */
    protected function getAdminNavigationItems(): array
    {
        return [
            [
                'title' => 'Dashboard',
                'href' => '/admin',
                'icon' => 'LayoutGrid',
            ],
            // Add more admin navigation items here
            // [
            //     'title' => 'Users',
            //     'href' => '/admin/users',
            //     'icon' => 'Users',
            // ],
        ];
    }

    /**
     * Get store panel navigation items
     *
     * @return array
     */
    protected function getStoreNavigationItems(): array
    {
        return [
            [
                'title' => 'Dashboard',
                'href' => '/store',
                'icon' => 'LayoutGrid',
            ],
            [
                'title' => 'Products',
                'href' => '/store/products',
                'icon' => 'BookOpen',
            ],
            [
                'title' => 'Orders',
                'href' => '/store/orders',
                'icon' => 'ShoppingCart',
            ],
            [
                'title' => 'Customers',
                'href' => '/store/customers',
                'icon' => 'Users',
            ],
            [
                'title' => 'Settings',
                'href' => '/store/settings',
                'icon' => 'Settings',
            ],
            // Add more store navigation items here
        ];
    }

    /**
     * Get default panel navigation items
     *
     * @return array
     */
    protected function getDefaultNavigationItems(): array
    {
        return [
            [
                'title' => 'Dashboard',
                'href' => '/dashboard',
                'icon' => 'LayoutGrid',
            ],
            // Add more default navigation items here
        ];
    }
}

