import { Head } from '@inertiajs/react';
import { Navbar } from '@/components/navbar';

export default function About() {
    return <div>
        <Head title="About Page" />

        <Navbar/>

        <div className="max-w-7xl mx-auto">
            <h1 className="text-3xl font-semibold">About Page</h1>
        </div>
    </div>
}
