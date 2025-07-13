import { DrawerButton } from '@/components/ui/drawer';
import ThemeController from '@/components/ui/theme-controller';
import useInitials from '@/hooks/use-initials';
import type { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';

function Navbar() {
    const { auth, name } = usePage<SharedData>().props;
    const getInitials = useInitials();

    return (
        <div className="fixed z-30 navbar bg-base-100 shadow-sm">
            {/* Drawer button */}
            <div className="flex-none lg:hidden">
                <DrawerButton />
            </div>

            <div className="flex flex-1 items-baseline">
                <Link href={route('home')} className="btn text-xl btn-ghost">
                    {name}
                </Link>

                <ul className="menu menu-horizontal hidden px-1 lg:flex">
                    <li>
                        <a href="#">Best Games</a>
                    </li>
                    <li>
                        <a href="#">New Releases</a>
                    </li>
                    <li>
                        <a href="#">Lists</a>
                    </li>
                    <li>
                        <a href="#">Genres</a>
                    </li>
                </ul>
            </div>

            <div className="flex gap-2">
                <input type="text" placeholder="Search" className="input-bordered input w-24 md:w-auto" />

                <div className="hidden lg:block">
                    <ThemeController />
                </div>

                {auth.user ? (
                    <>
                        <div className="dropdown dropdown-end">
                            {auth.user.avatar ? (
                                <div tabIndex={0} role="button" className="btn avatar btn-circle btn-ghost">
                                    <div className="w-10 rounded-full">
                                        <img alt="" src={auth.user.avatar} />
                                    </div>
                                </div>
                            ) : (
                                <div tabIndex={0} role="button" className="btn avatar avatar-placeholder btn-circle btn-ghost">
                                    <div className="w-10 rounded-full bg-neutral text-neutral-content">
                                        <span className="text-xs">{getInitials(auth.user.profile.username)}</span>
                                    </div>
                                </div>
                            )}
                            <ul tabIndex={0} className="dropdown-content menu z-1 mt-3 w-52 menu-sm rounded-box bg-base-100 p-2 shadow">
                                <li>
                                    <a className="justify-between">
                                        Profile
                                        <span className="badge">New</span>
                                    </a>
                                </li>
                                <li>
                                    <Link href={route('profile.edit')}>Settings</Link>
                                </li>
                                <li>
                                    <Link href={route('logout')} method="post" as="button">
                                        Logout
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </>
                ) : (
                    <div className="hidden gap-2 lg:flex">
                        <Link href={route('login')} className="btn">
                            Login
                        </Link>

                        <Link href={route('register')} className="btn btn-primary">
                            Register
                        </Link>
                    </div>
                )}
            </div>
        </div>
    );
}

export { Navbar };
