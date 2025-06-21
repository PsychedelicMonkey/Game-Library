import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
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
                <h1 className="mb-4 text-3xl font-semibold">Register</h1>

                <form onSubmit={submit}>
                    <Fieldset className="w-md rounded-box border border-base-300 bg-base-200 p-4">
                        <InputLabel htmlFor="name">Name</InputLabel>
                        <Input
                            type="text"
                            name="name"
                            id="name"
                            className="w-full"
                            required
                            tabIndex={1}
                            autoComplete="name"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                            disabled={processing}
                            placeholder="Full name"
                        />
                        <InputError message={errors.name} />

                        <InputLabel htmlFor="email">Email address</InputLabel>
                        <Input
                            type="email"
                            name="email"
                            id="email"
                            className="w-full"
                            required
                            tabIndex={2}
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
                            className="w-full"
                            required
                            tabIndex={3}
                            autoComplete="new-password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            disabled={processing}
                            placeholder="Password"
                        />
                        <InputError message={errors.password} />

                        <InputLabel htmlFor="password_confirmation">Password confirmation</InputLabel>
                        <Input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            className="w-full"
                            required
                            tabIndex={4}
                            value={data.password_confirmation}
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            disabled={processing}
                            placeholder="Confirm password"
                        />
                        <InputError message={errors.password_confirmation} />

                        <Button type="submit" disabled={processing} color="neutral" className="mt-4">
                            {processing ? <Loading size="sm" type="bars" /> : 'Register'}
                        </Button>
                    </Fieldset>
                </form>
            </div>
        </AppLayout>
    );
}
