import { Head } from '@inertiajs/react';

export default function Home() {
    return (
        <>
            <Head title={'Home Page'} />

            <div className="mx-auto max-w-7xl">
                <h1 className="text-3xl font-semibold text-gray-900">Home Page</h1>
            </div>
        </>
    );
}
