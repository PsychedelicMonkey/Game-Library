import Input from '@/components/input';
import InputError from '@/components/input-error';
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
                                <label className="label">Email</label>
                                <Input
                                    type="email"
                                    placeholder="Email"
                                    autoComplete="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                />
                                <InputError message={errors.email} />
                                <label className="label">Password</label>
                                <Input
                                    type="password"
                                    placeholder="Password"
                                    autoComplete="current-password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                />
                                <InputError message={errors.password} />
                                <div>
                                    <Link href={route('forgot-password')} className="link link-hover">
                                        Forgot password?
                                    </Link>
                                </div>
                                <label className="label">
                                    <input
                                        type="checkbox"
                                        name="remember"
                                        id="remember"
                                        className="checkbox"
                                        defaultChecked
                                        checked={data.remember}
                                        onClick={() => setData('remember', !data.remember)}
                                    />
                                    Remember me
                                </label>
                                <button type="submit" className="btn mt-4 btn-neutral" disabled={processing}>
                                    Login
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

export { LoginHero };
