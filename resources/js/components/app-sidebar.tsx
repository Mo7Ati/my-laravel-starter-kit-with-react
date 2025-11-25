import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { SharedData, type NavItem } from '@/types';
import { getIconByName } from '@/lib/icon-mapper';
import { Link, usePage } from '@inertiajs/react';
import { BookOpen, Folder } from 'lucide-react';
import AppLogo from './app-logo';

// Helper function to get dashboard URL based on current panel
function getDashboardUrl(panel: string): string {
    switch (panel) {
        case 'admin':
            return '/admin';
        case 'store':
            return '/store';
        default:
            return '/dashboard';
    }
}

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/react-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#react',
        icon: BookOpen,
    },
];

export function AppSidebar() {
    const page = usePage<SharedData>();
    const { panel, navigationItems } = page.props;

    // Map backend navigation items to frontend NavItem format with icon components
    const navItems: NavItem[] = (navigationItems || []).map((item) => ({
        title: item.title,
        href: item.href,
        icon: typeof item.icon === 'string' ? getIconByName(item.icon) : item.icon,
    }));

    const dashboardUrl = getDashboardUrl(panel || 'default');

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboardUrl} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={navItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
