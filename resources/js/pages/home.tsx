import Button from '@/components/button';
import Input from '@/components/input';
import InputError from '@/components/input-error';
import { LoadingBars } from '@/components/loading';
import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';

export default function Home() {
    return (
        <AppLayout>
            <Head title={'Home Page'} />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="text-3xl font-semibold text-gray-900 dark:text-gray-100">Home Page</h1>
                <h3>{route('home')}</h3>
            </div>

            <div>
                <Input type="text" id="name" name="name" />
                <InputError message="Form error" className="mt-2" />
            </div>

            <Button className="btn-primary btn-sm">
                <LoadingBars />
                Hello
            </Button>
        </AppLayout>
    );
}
