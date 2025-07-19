import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import { FloatingLabel } from '@/components/ui/floating-label';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { AppLayout } from '@/layouts/app-layout';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type LoginForm = {
    email: string;
    password: string;
    remember: boolean;
};

interface LoginProps {
    canResetPassword: boolean;
    status?: string;
}

export default function Login({ canResetPassword, status }: LoginProps) {
    const { data, setData, errors, post, processing, reset } = useForm<LoginForm>({
        email: '',
        password: '',
        remember: false,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <AppLayout>
            <Head title="Login" />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="my-4 text-3xl font-semibold">Login</h1>

                <form onSubmit={submit}>
                    <Fieldset className="rounded-box border border-base-300 bg-base-200 p-4 lg:w-md">
                        <div className="space-y-4">
                            {status && <Alert message={status} color="success" icon />}

                            <FloatingLabel label="Email address">
                                <Input
                                    type="email"
                                    name="email"
                                    id="email"
                                    className="w-full"
                                    placeholder="Email address"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    disabled={processing}
                                />
                                <InputError message={errors.email} className="mt-1" />
                            </FloatingLabel>

                            <FloatingLabel label="Password">
                                <Input
                                    type="password"
                                    name="password"
                                    id="password"
                                    className="w-full"
                                    required
                                    tabIndex={2}
                                    autoComplete="current-password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    disabled={processing}
                                    placeholder="Password"
                                />
                                <InputError message={errors.password} className="mt-1" />
                            </FloatingLabel>
                        </div>

                        {canResetPassword && (
                            <Link href={route('password.request')} className="link link-hover">
                                Forgot your password?
                            </Link>
                        )}

                        <InputLabel>
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                className="checkbox"
                                tabIndex={3}
                                checked={data.remember}
                                onClick={() => setData('remember', !data.remember)}
                                disabled={processing}
                            />
                            Remember me
                        </InputLabel>

                        <Button type="submit" disabled={processing} color="neutral" className="mt-2">
                            {processing ? <Loading size="sm" type="bars" /> : 'Login'}
                        </Button>
                    </Fieldset>
                </form>

                <div className="mt-6">
                    <p className="text-sm">
                        Don't have an account yet?{' '}
                        <Link href={route('register')} className="underline hover:text-accent">
                            Sign up now
                        </Link>
                    </p>
                </div>
            </div>
        </AppLayout>
    );
}
