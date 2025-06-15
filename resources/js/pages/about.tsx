import { AppLayout } from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';

export default function About() {
    return (
        <AppLayout>
            <Head title="About Page" />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="text-3xl font-semibold">About Page</h1>
            </div>
        </AppLayout>
    );
}
