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

            <div className="mx-auto max-w-7xl px-4 py-6 lg:px-6 lg:py-10">
                <h1 className="mb-8 text-3xl font-semibold">Register Your Account</h1>

                <div className="flex flex-col gap-12 lg:flex-row lg:gap-20">
                    <form onSubmit={submit} className="md:self-baseline">
                        <Fieldset className="rounded-box border border-base-300 bg-base-200 p-4 md:w-md">
                            <div className="space-y-4">
                                <FloatingLabel label="Full name">
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
                                    <InputError message={errors.name} className="mt-1" />
                                </FloatingLabel>

                                <FloatingLabel label="Email address">
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
                                        placeholder="Email address"
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
                                        tabIndex={3}
                                        autoComplete="new-password"
                                        value={data.password}
                                        onChange={(e) => setData('password', e.target.value)}
                                        disabled={processing}
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
                                        required
                                        tabIndex={4}
                                        value={data.password_confirmation}
                                        onChange={(e) => setData('password_confirmation', e.target.value)}
                                        disabled={processing}
                                        placeholder="Confirm password"
                                    />
                                    <InputError message={errors.password_confirmation} className="mt-1" />
                                </FloatingLabel>
                            </div>

                            <Button type="submit" disabled={processing} color="neutral" className="mt-4">
                                {processing ? <Loading size="sm" type="bars" /> : 'Register'}
                            </Button>
                        </Fieldset>
                    </form>

                    <div className="space-y-6 lg:max-w-lg">
                        <div className="space-y-4">
                            <h2 className="text-2xl">Rate & Review Games</h2>
                            <p className="text-sm text-base-content/50">Voice your opinion on the best and worst games of the year.</p>
                        </div>

                        <div className="space-y-4">
                            <h2 className="text-2xl">Social Feed</h2>
                            <p className="text-sm text-base-content/50">
                                Follow users to create your own personalized feed. Stay up to date with your friends' game ratings and reviews.
                            </p>
                        </div>

                        <div className="space-y-4">
                            <h2 className="text-2xl">Library</h2>
                            <p className="text-sm text-base-content/50">Keep track of games by saving them to your library.</p>
                        </div>

                        <div className="space-y-4">
                            <h2 className="text-2xl">Recommendations</h2>
                            <p className="text-sm text-base-content/50">Personalized recommendations based on the games you enjoy.</p>
                        </div>
                    </div>
                </div>

                <div className="mt-14">
                    <p className="text-xs">
                        <span className="font-bold">NOTE: </span>
                        We do not give or sell your information to anyone. We do not send you emails unless you forget your password or need to verify
                        your account.
                    </p>
                </div>
            </div>
        </AppLayout>
    );
}
