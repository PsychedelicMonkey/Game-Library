import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { useForm } from '@inertiajs/react';
import { FormEventHandler, useRef } from 'react';

export default function UpdatePasswordForm() {
    const passwordInput = useRef<HTMLInputElement>(null);
    const currentPasswordInput = useRef<HTMLInputElement>(null);

    const { data, setData, errors, put, processing, reset } = useForm({
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
            <fieldset className="fieldset">
                <InputLabel htmlFor="current_password">Current Password</InputLabel>
                <Input
                    type="password"
                    name="current_password"
                    id="current_password"
                    ref={currentPasswordInput}
                    value={data.current_password}
                    onChange={(e) => setData('current_password', e.target.value)}
                    autoComplete="current-password"
                    placeholder="Current password"
                />
                <InputError message={errors.current_password} />

                <InputLabel htmlFor="password">Password</InputLabel>
                <Input
                    type="password"
                    name="password"
                    id="password"
                    ref={currentPasswordInput}
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                    autoComplete="new-password"
                    placeholder="New Password"
                />
                <InputError message={errors.password} />

                <InputLabel htmlFor="password_confirmation">Password Confirmation</InputLabel>
                <Input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    value={data.password_confirmation}
                    onChange={(e) => setData('password_confirmation', e.target.value)}
                    autoComplete="new-password"
                    placeholder="Confirm password"
                />
                <InputError message={errors.password_confirmation} />
            </fieldset>

            <Button type="submit" color="primary" disabled={processing}>
                {processing && <Loading size="sm" />}
                Save
            </Button>
        </form>
    );
}
