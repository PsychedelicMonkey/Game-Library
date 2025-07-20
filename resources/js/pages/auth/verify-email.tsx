import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Loading } from '@/components/ui/loading';
import { AppLayout } from '@/layouts/app-layout';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function VerifyEmail({ status }: { status?: string }) {
    const { post, processing } = useForm({});

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('verification.send'));
    };

    return (
        <AppLayout>
            <Head title="Verify Email" />

            <div className="mx-auto max-w-7xl space-y-4 p-4 lg:p-6">
                <div>
                    <h1 className="my-4 text-3xl font-semibold">Verify Your Email</h1>

                    <p>Please verify your email address by clicking on the link we just emailed to you.</p>
                </div>

                {status === 'verification-link-sent' && (
                    <Alert
                        message="A new verification link has been sent to the email address you provided during registration."
                        color="success"
                        icon
                    />
                )}

                <form onSubmit={submit} className="space-y-6 text-center">
                    <Button color="neutral" disabled={processing}>
                        {processing ? <Loading type="bars" /> : 'Resend verification email'}
                    </Button>

                    <Link href={route('logout')} method="post" className="btn mx-auto block text-sm btn-ghost">
                        Log out
                    </Link>
                </form>
            </div>
        </AppLayout>
    );
}
