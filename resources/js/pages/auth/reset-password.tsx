import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import { FloatingLabel } from '@/components/ui/floating-label';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { Loading } from '@/components/ui/loading';
import { AppLayout } from '@/layouts/app-layout';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

interface ResetPasswordProps {
    token: string;
    email: string;
}

type ResetPasswordForm = {
    token: string;
    email: string;
    password: string;
    password_confirmation: string;
};

export default function ResetPassword({ token, email }: ResetPasswordProps) {
    const { data, setData, post, processing, errors, reset } = useForm<Required<ResetPasswordForm>>({
        token: token,
        email: email,
        password: '',
        password_confirmation: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('password.store'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <AppLayout>
            <Head title="Reset password" />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="mb-4 text-3xl font-semibold">Reset your password</h1>

                <form onSubmit={submit}>
                    <Fieldset className="w-md rounded-box border border-base-300 bg-base-200 p-4">
                        <div className="space-y-4">
                            <FloatingLabel label="Email address">
                                <Input
                                    type="email"
                                    name="email"
                                    id="email"
                                    className="w-full"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    disabled={processing}
                                    readOnly
                                />
                                <InputError message={errors.email} className="mt-1" />
                            </FloatingLabel>

                            <FloatingLabel label="Password">
                                <Input
                                    type="password"
                                    name="password"
                                    id="password"
                                    className="w-full"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    disabled={processing}
                                    autoFocus
                                    placeholder="Password"
                                />
                                <InputError message={errors.password} className="mt-1" />
                            </FloatingLabel>

                            <FloatingLabel label="Confirm password">
                                <Input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    className="w-full"
                                    value={data.password_confirmation}
                                    onChange={(e) => setData('password_confirmation', e.target.value)}
                                    disabled={processing}
                                    placeholder="Confirm password"
                                />
                                <InputError message={errors.password_confirmation} className="mt-1" />
                            </FloatingLabel>
                        </div>

                        <Button type="submit" color="neutral" disabled={processing} className="mt-4">
                            {processing ? <Loading size="sm" type="bars" /> : 'Reset password'}
                        </Button>
                    </Fieldset>
                </form>
            </div>
        </AppLayout>
    );
}
