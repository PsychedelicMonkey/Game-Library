import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { AppLayout } from '@/layouts/app-layout';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { FloatingLabel } from '@/components/ui/floating-label';

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
                <h1 className="my-4 text-3xl font-semibold">Forgot your password?</h1>

                <form onSubmit={submit}>
                    <Fieldset className="w-md rounded-box border border-base-300 bg-base-200 p-4">
                        {status && <Alert message={status} color="success" icon className="mb-4" />}

                        <FloatingLabel label="Email address">
                            <Input
                                type="email"
                                name="email"
                                id="email"
                                className="w-full"
                                autoComplete="off"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                                disabled={processing}
                                autoFocus
                                placeholder="Email address"
                            />
                            <InputError message={errors.email} className="mt-1" />
                        </FloatingLabel>

                        <Button type="submit" color="neutral" disabled={processing} className="mt-4">
                            {processing ? <Loading size="sm" type="bars" /> : 'Send email'}
                        </Button>
                    </Fieldset>
                </form>
            </div>
        </AppLayout>
    );
}
