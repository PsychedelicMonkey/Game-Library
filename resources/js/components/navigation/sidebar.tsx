import { DrawerSide } from '@/components/ui/drawer';
import ThemeController from '@/components/ui/theme-controller';
import { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';

export default function Sidebar() {
    const { auth } = usePage<SharedData>().props;

    return (
        <DrawerSide>
            {auth.user ? (
                <>
                    <li>
                        <Link href={route('logout')} method="post" as="button">
                            Logout
                        </Link>
                    </li>
                </>
            ) : (
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
        </DrawerSide>
    );
}
