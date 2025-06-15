import { Navbar } from '@/components/navbar';
import { Head } from '@inertiajs/react';

export default function Home() {
    return (
        <div>
            <Head title="Home Page" />

            <Navbar />

            <div className="mx-auto max-w-7xl">
                <h1 className="text-3xl font-semibold">Home Page</h1>
            </div>
        </div>
    );
}
