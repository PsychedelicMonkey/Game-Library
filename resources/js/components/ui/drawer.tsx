import { Icon } from '@/components/ui/icon';
import { cn } from '@/lib/utils';
import { MenuIcon } from 'lucide-react';
import * as React from 'react';

function Drawer({ children }: React.HTMLProps<HTMLDivElement>) {
    return <div className="drawer">{children}</div>;
}

function DrawerButton() {
    return (
        <label htmlFor="navbar-drawer" aria-label="open sidebar" className="btn btn-square btn-ghost">
            <Icon iconNode={MenuIcon} />
        </label>
    );
}

function DrawerContent({ children, className, ...props }: React.HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('drawer-content', className)} {...props}>
            {children}
        </div>
    );
}

function DrawerSide({ children }: React.HTMLProps<'ul'>) {
    return (
        <div className="drawer-side z-40">
            <label htmlFor="navbar-drawer" aria-label="close sidebar" className="drawer-overlay"></label>
            <ul className="menu min-h-full w-80 bg-base-200 p-4">{children}</ul>
        </div>
    );
}

function DrawerToggle() {
    return <input type="checkbox" id="navbar-drawer" className="drawer-toggle" />;
}

export { Drawer, DrawerButton, DrawerContent, DrawerSide, DrawerToggle };
