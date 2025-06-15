import { Button } from '@/components/button';
import Input from '@/components/input';
import InputError from '@/components/input-error';
import { AppLayout } from '@/layouts/app-layout';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type RegisterForm = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
};

export default function Register() {
    const { data, setData, errors, post, processing, reset } = useForm<RegisterForm>({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <AppLayout>
            <Head title="Register" />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="text-3xl font-semibold">Register</h1>

                <form onSubmit={submit}>
                    <fieldset className="fieldset">
                        <label htmlFor="name">Name</label>
                        <Input
                            type="text"
                            name="name"
                            id="name"
                            required
                            tabIndex={1}
                            autoComplete="name"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                            disabled={processing}
                            placeholder="Full name"
                        />
                        <InputError message={errors.name} />

                        <label htmlFor="email">Email address</label>
                        <Input
                            type="email"
                            name="email"
                            id="email"
                            required
                            tabIndex={2}
                            autoComplete="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            disabled={processing}
                            placeholder="email@example.com"
                        />
                        <InputError message={errors.email} />

                        <label htmlFor="password">Password</label>
                        <Input
                            type="password"
                            name="password"
                            id="password"
                            required
                            tabIndex={3}
                            autoComplete="new-password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            disabled={processing}
                            placeholder="Password"
                        />
                        <InputError message={errors.password} />

                        <label htmlFor="password_confirmation">Password confirmation</label>
                        <Input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            required
                            tabIndex={4}
                            value={data.password_confirmation}
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            disabled={processing}
                            placeholder="Confirm password"
                        />
                        <InputError message={errors.password_confirmation} />
                    </fieldset>

                    <Button type="submit" disabled={processing} color="primary">
                        Register
                    </Button>
                </form>
            </div>
        </AppLayout>
    );
}
