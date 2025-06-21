import { Button } from '@/components/ui/button';
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
            <fieldset className="fieldset">
                <InputLabel htmlFor="name">Name</InputLabel>
                <Input type="text" name="name" id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                <InputError message={errors.name} />

                <InputLabel htmlFor="email">Email address</InputLabel>
                <Input type="email" name="email" id="email" value={data.email} onChange={(e) => setData('email', e.target.value)} />
                <InputError message={errors.email} />
            </fieldset>

            <Button type="submit" color="primary" disabled={processing}>
                {processing && <Loading size="sm" />}
                Save
            </Button>
        </form>
    );
}
