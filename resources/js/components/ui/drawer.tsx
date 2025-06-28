import { Navbar } from '@/components/navbar';
import ThemeController from '@/components/ui/theme-controller';
import type { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
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
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" className="inline-block h-6 w-6 stroke-current">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
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
