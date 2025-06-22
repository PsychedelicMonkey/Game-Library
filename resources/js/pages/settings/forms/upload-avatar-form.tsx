import { Button } from '@/components/ui/button';
import { Fieldset, FieldsetLegend } from '@/components/ui/fieldset';
import FileInput from '@/components/ui/file-input';
import InputError from '@/components/ui/input-error';
import { InputLabel } from '@/components/ui/input-label';
import { Loading } from '@/components/ui/loading';
import Progress from '@/components/ui/progress';
import Textarea from '@/components/ui/textarea';
import { useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { Alert } from '@/components/ui/alert';
import { Transition } from '@headlessui/react';

type UploadForm = {
    file: File | null;
    caption: string;
};

export default function UploadAvatarForm() {
    const { data, setData, errors, post, processing, progress, recentlySuccessful } = useForm<Required<UploadForm>>({
        file: null,
        caption: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('upload-avatar'), {
            preserveScroll: true,
        });
    };

    return (
        <form onSubmit={submit}>
            <Fieldset className="rounded-box border border-base-300 bg-base-200 p-4">
                <FieldsetLegend>Avatar</FieldsetLegend>

                <Transition
                    show={recentlySuccessful}
                    enter="transition ease-in-out"
                    enterFrom="opacity-0"
                    leave="transition ease-in-out"
                    leaveTo="opacity-0"
                >
                    <Alert message="Avatar uploaded" color="success" icon />
                </Transition>

                <InputLabel htmlFor="avatar">File</InputLabel>
                <FileInput
                    name="avatar"
                    id="avatar"
                    className="w-full"
                    required
                    onChange={(e) => setData('file', e.target.files[0])}
                    disabled={processing}
                />
                {processing && <Progress value={progress?.percentage} color="info" className="my-2 w-full" />}
                <InputError message={errors.file} />

                <InputLabel htmlFor="caption">Caption</InputLabel>
                <Textarea
                    name="caption"
                    id="caption"
                    className="w-full"
                    value={data.caption}
                    onChange={(e) => setData('caption', e.target.value)}
                    disabled={processing}
                ></Textarea>
                <InputError message={errors.caption} />

                <Button type="submit" color="neutral" className="mt-4" disabled={processing}>
                    {processing ? <Loading size="sm" type="bars" /> : 'Save'}
                </Button>
            </Fieldset>
        </form>
    );
}
