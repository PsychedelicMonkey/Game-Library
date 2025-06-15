import { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';

function Navbar() {
    const { name } = usePage<SharedData>().props;

    return (
        <div className="navbar bg-base-100 shadow-sm">
            <div className="flex-1">
                <Link href={route('home')} className="btn text-xl btn-ghost">
                    {name}
                </Link>
            </div>
            <div className="flex gap-2">
                <input type="text" placeholder="Search" className="input-bordered input w-24 md:w-auto" />
                <div className="dropdown dropdown-end">
                    <div tabIndex={0} role="button" className="btn avatar btn-circle btn-ghost">
                        <div className="w-10 rounded-full">
                            <img
                                alt="Tailwind CSS Navbar component"
                                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                            />
                        </div>
                    </div>
                    <ul tabIndex={0} className="dropdown-content menu z-1 mt-3 w-52 menu-sm rounded-box bg-base-100 p-2 shadow">
                        <li>
                            <a className="justify-between">
                                Profile
                                <span className="badge">New</span>
                            </a>
                        </li>
                        <li>
                            <a>Settings</a>
                        </li>
                        <li>
                            <a>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    );
}

export { Navbar };
