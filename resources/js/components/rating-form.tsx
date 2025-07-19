import RatingProgress from '@/components/rating-progress';
import { Button } from '@/components/ui/button';
import { Fieldset, FieldsetLegend } from '@/components/ui/fieldset';
import { FloatingLabel } from '@/components/ui/floating-label';
import Input from '@/components/ui/input';
import InputError from '@/components/ui/input-error';
import { Loading } from '@/components/ui/loading';
import Textarea from '@/components/ui/textarea';
import type { Game } from '@/types/library';
import { router, useForm } from '@inertiajs/react';
import type { FormEventHandler } from 'react';

type Form = {
    score: number;
    gameId: string;
    review: string;
};

export default function RatingForm({ game }: { game: Game }) {
    const { data, setData, errors, post, processing, reset } = useForm<Required<Form>>({
        score: 50,
        gameId: game.id,
        review: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('rating.store'), {
            preserveScroll: true,
            onFinish: () => {
                reset('score', 'review');
                router.reload({ only: ['reviews'] });
            },
        });
    };

    return (
        <form onSubmit={submit}>
            <Fieldset className="border border-base-300 bg-base-200 p-4">
                <FieldsetLegend>Rating</FieldsetLegend>

                <div className="mb-6 text-center">
                    <RatingProgress value={data.score} />
                </div>

                <FloatingLabel label="Score">
                    <Input
                        type="number"
                        id="score"
                        name="score"
                        placeholder="Score"
                        className="w-full"
                        min={1}
                        max={100}
                        required
                        value={data.score}
                        onChange={(e) => setData('score', e.target.valueAsNumber)}
                        disabled={processing}
                    />
                    <InputError message={errors.score} className="mt-1" />
                </FloatingLabel>
            </Fieldset>

            <Fieldset className="border border-base-300 bg-base-200 p-4">
                <FieldsetLegend>Review</FieldsetLegend>

                <FloatingLabel label="Review">
                    <Textarea
                        id="review"
                        name="review"
                        placeholder="Review"
                        className="w-full"
                        value={data.review}
                        onChange={(e) => setData('review', e.target.value)}
                        disabled={processing}
                    />
                </FloatingLabel>

                {/* TODO: Add public visibility option */}
            </Fieldset>

            <Button type="submit" color="neutral" className="mt-4 w-full" disabled={processing}>
                {processing ? <Loading type="bars" /> : 'Submit rating'}
            </Button>
        </form>
    );
}
