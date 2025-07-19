import { Alert } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import { FloatingLabel } from '@/components/ui/floating-label';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { Loading } from '@/components/ui/loading';
import { Transition } from '@headlessui/react';
import { useForm } from '@inertiajs/react';
import { FormEventHandler, useRef } from 'react';

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
            <Fieldset className="rounded-box border border-base-300 bg-base-200 p-4 lg:w-md">
                <div className="space-y-4">
                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <Alert message="Password updated" color="success" icon />
                    </Transition>

                    <FloatingLabel label="Current Password">
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
                            placeholder="Current Password"
                        />
                        <InputError message={errors.current_password} className="mt-1" />
                    </FloatingLabel>

                    <FloatingLabel label="Password">
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
                        <InputError message={errors.password} className="mt-1" />
                    </FloatingLabel>

                    <FloatingLabel label="Confirm Password">
                        <Input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            className="w-full"
                            value={data.password_confirmation}
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            disabled={processing}
                            autoComplete="new-password"
                            placeholder="Confirm Password"
                        />
                        <InputError message={errors.password_confirmation} className="mt-1" />
                    </FloatingLabel>
                </div>

                <Button type="submit" color="primary" disabled={processing} className="mt-4">
                    {processing ? <Loading size="sm" type="bars" /> : 'Save'}
                </Button>
            </Fieldset>
        </form>
    );
}
