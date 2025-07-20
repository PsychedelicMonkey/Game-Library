import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { AppLayout } from '@/layouts/app-layout';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function ConfirmPassword() {
    const { data, setData, errors, post, processing, reset } = useForm<Required<{ password: string }>>({
        password: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('password.confirm'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <AppLayout>
            <Head title="Confirm your password" />

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="text-3xl font-semibold">Confirm your password</h1>
                <p>This is a secure area of the application. Please confirm your password before continuing.</p>

                <form onSubmit={submit}>
                    <Fieldset className="mt-6 w-xs rounded-box border border-base-300 bg-base-200 p-3">
                        <InputLabel htmlFor="password">Password</InputLabel>
                        <Input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            autoComplete="current-password"
                            autoFocus
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                        />
                        <InputError message={errors.password} className="mt-1" />

                        <Button type="submit" color="neutral" className="mt-2" disabled={processing}>
                            {processing ? <Loading type="bars" /> : 'Confirm password'}
                        </Button>
                    </Fieldset>
                </form>
            </div>
        </AppLayout>
    );
}
