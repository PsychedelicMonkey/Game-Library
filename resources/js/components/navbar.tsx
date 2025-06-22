import ThemeController from '@/components/ui/theme-controller';
import useInitials from '@/hooks/use-initials';
import { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';

function Navbar() {
    const { auth, name } = usePage<SharedData>().props;
    const getInitials = useInitials();

    return (
        <div className="fixed z-40 navbar bg-base-100 shadow-sm">
            <div className="flex-1">
                <Link href={route('home')} className="btn text-xl btn-ghost">
                    {name}
                </Link>
            </div>
            <div className="flex gap-2">
                <input type="text" placeholder="Search" className="input-bordered input w-24 md:w-auto" />

                <ThemeController />

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
                    <>
                        <Link href={route('login')} className="btn">
                            Login
                        </Link>
                        <Link href={route('register')} className="btn btn-primary">
                            Register
                        </Link>
                    </>
                )}
            </div>
        </div>
    );
}

export { Navbar };
