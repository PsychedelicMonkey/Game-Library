import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type LoginForm = {
    email: string;
    password: string;
    remember: boolean;
};

function LoginHero() {
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
        <div className="hero min-h-screen bg-base-200">
            <div className="hero-content flex-col lg:flex-row-reverse">
                <div className="text-center lg:text-left">
                    <h1 className="text-5xl font-bold">Login now!</h1>
                    <p className="py-6">
                        Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut
                        repudiandae et a id nisi.
                    </p>
                </div>
                <div className="card w-full max-w-sm shrink-0 bg-base-100 shadow-2xl">
                    <div className="card-body">
                        <form onSubmit={submit}>
                            <fieldset className="fieldset">
                                <InputLabel htmlFor="email">Email</InputLabel>
                                <Input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Email"
                                    autoComplete="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    disabled={processing}
                                />
                                <InputError message={errors.email} />
                                <InputLabel htmlFor="password">Password</InputLabel>
                                <Input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Password"
                                    autoComplete="current-password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    disabled={processing}
                                />
                                <InputError message={errors.password} />
                                <div>
                                    <Link href={route('password.request')} className="link link-hover">
                                        Forgot password?
                                    </Link>
                                </div>
                                <InputLabel>
                                    <input
                                        type="checkbox"
                                        name="remember"
                                        id="remember"
                                        className="checkbox"
                                        checked={data.remember}
                                        onClick={() => setData('remember', !data.remember)}
                                        disabled={processing}
                                    />
                                    Remember me
                                </InputLabel>
                                <Button type="submit" className="mt-4" color="neutral" disabled={processing}>
                                    {processing && <Loading size="sm" />}
                                    Login
                                </Button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

function ImageHero() {
    return (
        <div
            className="hero min-h-screen"
            style={{
                backgroundImage: 'url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp)',
            }}
        >
            <div className="hero-overlay"></div>
            <div className="hero-content text-center text-neutral-content">
                <div className="max-w-md">
                    <h1 className="mb-5 text-5xl font-bold">Hello there</h1>
                    <p className="mb-5">
                        Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut
                        repudiandae et a id nisi.
                    </p>
                    <button className="btn btn-primary">Get Started</button>
                </div>
            </div>
        </div>
    );
}

export { ImageHero, LoginHero };
