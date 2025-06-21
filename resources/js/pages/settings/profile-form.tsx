import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import Toggle from '@/components/ui/input-toggle';
import { Loading } from '@/components/ui/loading';
import Textarea from '@/components/ui/textarea';
import { SharedData } from '@/types';
import { useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type ProfileForm = {
    username: string;
    bio: string;
    is_public: boolean;
};

export default function ProfileForm() {
    const { auth } = usePage<SharedData>().props;

    const { data, setData, errors, patch, processing } = useForm<Required<ProfileForm>>({
        username: auth.user.profile.username,
        bio: auth.user.profile.bio,
        is_public: auth.user.profile.is_public,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        patch(route('profile.update'), {
            preserveScroll: true,
        });
    };

    return (
        <form onSubmit={submit}>
            <fieldset className="fieldset">
                <InputLabel htmlFor="username">Username</InputLabel>
                <Input type="text" name="username" id="username" value={data.username} onChange={(e) => setData('username', e.target.value)} />
                <InputError message={errors.username} />

                <InputLabel htmlFor="bio">Bio</InputLabel>
                <Textarea name="bio" id="bio" value={data.bio} onChange={(e) => setData('bio', e.target.value)} />
                <InputError message={errors.bio} />

                <InputLabel htmlFor="is_public">Visible to public</InputLabel>
                <Toggle
                    name="is_public"
                    id="is_public"
                    defaultChecked={data.is_public}
                    onClick={() => setData('is_public', !data.is_public)}
                    color="success"
                />
                <InputError message={errors.is_public} />
            </fieldset>

            <Button type="submit" color="primary" disabled={processing}>
                {processing && <Loading size="sm" />}
                Save
            </Button>
        </form>
    );
}
