import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { useForm } from '@inertiajs/react';
import { FormEventHandler, useRef } from 'react';
import { Alert } from '@/components/ui/alert';
import { Transition } from '@headlessui/react';

export default function UpdatePasswordForm() {
    const passwordInput = useRef<HTMLInputElement>(null);
    const currentPasswordInput = useRef<HTMLInputElement>(null);

    const { data, setData, errors, put, processing, reset, recentlySuccessful } = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        put(route('password.update'), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: (errors) => {
                if (errors.password) {
                    reset('password', 'password_confirmation');
                    passwordInput.current?.focus();
                }

                if (errors.current_password) {
                    reset('current_password');
                    currentPasswordInput.current?.focus();
                }
            },
        });
    };

    return (
        <form onSubmit={submit}>
            <Fieldset className="w-md rounded-box border border-base-300 bg-base-200 p-4">
                <Transition
                    show={recentlySuccessful}
                    enter="transition ease-in-out"
                    enterFrom="opacity-0"
                    leave="transition ease-in-out"
                    leaveTo="opacity-0"
                >
                    <Alert message="Password updated" color="success" icon />
                </Transition>

                <InputLabel htmlFor="current_password">Current Password</InputLabel>
                <Input
                    type="password"
                    name="current_password"
                    id="current_password"
                    className="w-full"
                    ref={currentPasswordInput}
                    value={data.current_password}
                    onChange={(e) => setData('current_password', e.target.value)}
                    disabled={processing}
                    autoComplete="current-password"
                    placeholder="Current password"
                />
                <InputError message={errors.current_password} />

                <InputLabel htmlFor="password">Password</InputLabel>
                <Input
                    type="password"
                    name="password"
                    id="password"
                    className="w-full"
                    ref={currentPasswordInput}
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                    disabled={processing}
                    autoComplete="new-password"
                    placeholder="New Password"
                />
                <InputError message={errors.password} />

                <InputLabel htmlFor="password_confirmation">Password Confirmation</InputLabel>
                <Input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    className="w-full"
                    value={data.password_confirmation}
                    onChange={(e) => setData('password_confirmation', e.target.value)}
                    disabled={processing}
                    autoComplete="new-password"
                    placeholder="Confirm password"
                />
                <InputError message={errors.password_confirmation} />

                <Button type="submit" color="primary" disabled={processing} className="mt-4">
                    {processing ? <Loading size="sm" type="bars" /> : 'Save'}
                </Button>
            </Fieldset>
        </form>
    );
}
