import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
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
                <h1 className="text-3xl font-semibold">Reset your password</h1>

                <form onSubmit={submit}>
                    <fieldset className="fieldset">
                        <InputLabel htmlFor="email">Email Address</InputLabel>
                        <Input type="email" name="email" id="email" value={data.email} onChange={(e) => setData('email', e.target.value)} readOnly />
                        <InputError message={errors.email} />

                        <InputLabel htmlFor="password">Password</InputLabel>
                        <Input
                            type="password"
                            name="password"
                            id="password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            autoFocus
                            placeholder="Password"
                        />
                        <InputError message={errors.password} />

                        <InputLabel htmlFor="password_confirmation">Password Confirmation</InputLabel>
                        <Input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            value={data.password_confirmation}
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            placeholder="Confirm password"
                        />
                        <InputError message={errors.password_confirmation} />
                    </fieldset>

                    <Button type="submit" color="primary" disabled={processing}>
                        Reset password
                    </Button>
                </form>
            </div>
        </AppLayout>
    );
}
