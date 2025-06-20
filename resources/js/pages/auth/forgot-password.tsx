import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { AppLayout } from '@/layouts/app-layout';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function ForgotPassword({ status }: { status?: string }) {
    const { data, setData, post, processing, errors } = useForm<Required<{ email: string }>>({
        email: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('password.email'));
    };

    return (
        <AppLayout>
            <Head title="Forgot Password" />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                {status && <Alert message={status} color="success" icon />}

                <h1 className="text-3xl font-semibold">Forgot your password?</h1>

                <form onSubmit={submit}>
                    <fieldset className="fieldset">
                        <InputLabel htmlFor="email">Email address</InputLabel>
                        <Input
                            type="email"
                            name="email"
                            id="email"
                            autoComplete="off"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            autoFocus
                            placeholder="email@example.com"
                        />
                        <InputError message={errors.email} />
                    </fieldset>

                    <Button type="submit" color="primary" disabled={processing}>
                        Send email
                    </Button>
                </form>
            </div>
        </AppLayout>
    );
}
