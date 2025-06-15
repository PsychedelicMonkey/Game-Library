import { Navbar } from '@/components/navbar';
import { Head } from '@inertiajs/react';

export default function About() {
    return (
        <div>
            <Head title="About Page" />

            <Navbar />

            <div className="mx-auto max-w-7xl">
                <h1 className="text-3xl font-semibold">About Page</h1>
            </div>
        </div>
    );
}
