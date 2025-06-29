import { Navbar } from '@/components/navbar';
import { Icon } from '@/components/ui/icon';
import ThemeController from '@/components/ui/theme-controller';
import type { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { MenuIcon } from 'lucide-react';
import * as React from 'react';

function Drawer({ children }: React.HTMLProps<HTMLDivElement>) {
    return (
        <div className="drawer">
            <input type="checkbox" id="navbar-drawer" className="drawer-toggle" />
            <div className="drawer-content flex flex-col">
                {/* Navbar */}
                <Navbar />

                {/* Page content */}
                {children}
            </div>

            <DrawerSide />
        </div>
    );
}

function DrawerButton() {
    return (
        <label htmlFor="navbar-drawer" aria-label="open sidebar" className="btn btn-square btn-ghost">
            <Icon iconNode={MenuIcon} />
        </label>
    );
}

function DrawerSide() {
    const { auth } = usePage<SharedData>().props;

    return (
        <div className="drawer-side z-40">
            <label htmlFor="navbar-drawer" aria-label="close sidebar" className="drawer-overlay"></label>
            <ul className="menu min-h-full w-80 bg-base-200 p-4">
                {!auth.user && (
                    <>
                        <li>
                            <Link href={route('login')}>Login</Link>
                        </li>

                        <li>
                            <Link href={route('register')}>Register</Link>
                        </li>
                    </>
                )}

                <ThemeController />
            </ul>
        </div>
    );
}

export { Drawer, DrawerButton, DrawerSide };
