import { Hero } from '@/components/hero';
import { LoginHero } from '@/components/login-hero';
import { AppLayout } from '@/layouts/app-layout';
import { SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

export default function Home() {
    const { auth } = usePage<SharedData>().props;

    return (
        <AppLayout>
            <Head title="Home Page" />

            {auth.user ? <Hero /> : <LoginHero />}
        </AppLayout>
    );
}
