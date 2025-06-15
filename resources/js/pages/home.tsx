import { LoginHero } from '@/components/login-hero';
import { AppLayout } from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';

export default function Home() {
    return (
        <AppLayout>
            <Head title="Home Page" />

            <LoginHero />
        </AppLayout>
    );
}
