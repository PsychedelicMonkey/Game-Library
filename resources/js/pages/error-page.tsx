import { Head, Link } from '@inertiajs/react';

export default function ErrorPage({ status }: { status: number }) {
    const title = {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
    }[status];

    const description = {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[status];

    return (
        <div className="flex min-h-screen flex-col justify-center">
            <Head title={title} />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <div className="space-y-6 rounded-box border border-base-300 bg-base-200 p-12 text-center">
                    <h1 className="text-3xl font-bold uppercase">{title}</h1>
                    <div className="text-lg text-secondary-content">{description}</div>
                    <Link href={route('home')} className="btn btn-soft btn-lg btn-secondary">
                        Go back to home page
                    </Link>
                </div>
            </div>
        </div>
    );
}
