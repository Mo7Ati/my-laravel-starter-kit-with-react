import { NavItem } from '@/types';
import { PanelType } from '@/types/dashboard';
import { InertiaLinkProps } from '@inertiajs/react';
import { type ClassValue, clsx } from 'clsx';
import { BookOpen, LayoutGrid, ShoppingBag, UserCog, Users } from 'lucide-react';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function isSameUrl(
    url1: NonNullable<InertiaLinkProps['href']>,
    url2: NonNullable<InertiaLinkProps['href']>,
) {
    return resolveUrl(url1) === resolveUrl(url2);
}

export function resolveUrl(url: NonNullable<InertiaLinkProps['href']>): string {
    return typeof url === 'string' ? url : url.url;
}

export function getPanelNavItems(panel: PanelType): NavItem[] {
    switch (panel) {
        case PanelType.ADMIN: return getAdminPanelNavItems();
        case PanelType.STORE: return getStorePanelNavItems();
        default: return [];
    }
}


export function getAdminPanelNavItems(): NavItem[] {
    return [
        {
            title: 'Dashboard',
            href: '/admin',
            icon: LayoutGrid,
        },
        {
            title: 'Users',
            href: '/admin/users',
            icon: Users,
        },
        {
            title: 'Admins',
            href: '/admin/admins',
            icon: UserCog,
        },
    ];
}
export function getStorePanelNavItems(): NavItem[] {
    return [
        {
            title: 'Dashboard',
            href: '/store',
            icon: LayoutGrid,
        },
        {
            title: 'Products',
            href: '/store/products',
            icon: BookOpen,
        },
        {
            title: 'Orders',
            href: '/store/orders',
            icon: ShoppingBag,
        },
    ];
}
