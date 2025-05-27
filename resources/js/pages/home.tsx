import Navbar from '@/components/navbar';
import { Head } from '@inertiajs/react';

export default function Home() {
    return (
        <>
            <Head title={'Home Page'} />

            <Navbar />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="text-3xl font-semibold text-gray-900 dark:text-gray-100">Home Page</h1>
                <h3>{route('home')}</h3>
            </div>
        </>
    );
}
