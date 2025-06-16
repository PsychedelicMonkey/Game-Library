import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { AppLayout } from '@/layouts/app-layout';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type LoginForm = {
    email: string;
    password: string;
    remember: boolean;
};

export default function Login() {
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
                <h1 className="text-3xl font-semibold">Login</h1>

                <form onSubmit={submit}>
                    <fieldset className="fieldset">
                        <InputLabel htmlFor="email">Email address</InputLabel>
                        <Input
                            type="email"
                            name="email"
                            id="email"
                            required
                            autoFocus
                            tabIndex={1}
                            autoComplete="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            disabled={processing}
                            placeholder="email@example.com"
                        />
                        <InputError message={errors.email} />

                        <InputLabel htmlFor="password">Password</InputLabel>
                        <Input
                            type="password"
                            name="password"
                            id="password"
                            required
                            tabIndex={2}
                            autoComplete="current-password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            disabled={processing}
                            placeholder="Password"
                        />
                        <InputError message={errors.password} />

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
                    </fieldset>

                    <Button type="submit" disabled={processing} color="primary">
                        {processing && <Loading size="sm" />}
                        Login
                    </Button>
                </form>
            </div>
        </AppLayout>
    );
}
