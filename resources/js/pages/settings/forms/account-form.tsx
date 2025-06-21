import { Button } from '@/components/ui/button';
import { Fieldset } from '@/components/ui/fieldset';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import { SharedData } from '@/types';
import { useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type ProfileForm = {
    name: string;
    email: string;
};

export default function AccountForm() {
    const { auth } = usePage<SharedData>().props;

    const { data, setData, errors, patch, processing } = useForm<Required<ProfileForm>>({
        name: auth.user.name,
        email: auth.user.email,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        patch(route('account.update'), {
            preserveScroll: true,
        });
    };

    return (
        <form onSubmit={submit}>
            <Fieldset className="w-md rounded-box border border-base-300 bg-base-200 p-4">
                <InputLabel htmlFor="name">Name</InputLabel>
                <Input
                    type="text"
                    name="name"
                    id="name"
                    className="w-full"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    disabled={processing}
                />
                <InputError message={errors.name} />

                <InputLabel htmlFor="email">Email address</InputLabel>
                <Input
                    type="email"
                    name="email"
                    id="email"
                    className="w-full"
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                    disabled={processing}
                />
                <InputError message={errors.email} />

                <Button type="submit" color="primary" disabled={processing} className="mt-4">
                    {processing ? <Loading size="sm" type="bars" /> : 'Save'}
                </Button>
            </Fieldset>
        </form>
    );
}
