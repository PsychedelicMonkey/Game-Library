import { AppLayout } from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';

export default function Home() {
    return (
        <AppLayout>
            <Head title="Home Page" />

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
                            <fieldset className="fieldset">
                                <label className="label">Email</label>
                                <input type="email" className="input" placeholder="Email" />
                                <label className="label">Password</label>
                                <input type="password" className="input" placeholder="Password" />
                                <div>
                                    <a className="link link-hover">Forgot password?</a>
                                </div>
                                <button className="btn mt-4 btn-neutral">Login</button>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
