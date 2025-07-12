import RatingProgress from '@/components/rating-progress';
import { AvatarPlaceholderSmall } from '@/components/ui/avatar';
import type { Review } from '@/types/library';
import moment from 'moment';

export default function ReviewCard({ review }: { review: Review }) {
    return (
        <div className="border border-base-300 bg-base-200 p-6">
            <div className="grid gap-12 md:grid-cols-6">
                <div className="flex flex-col items-center gap-4 text-center md:col-span-1">
                    <AvatarPlaceholderSmall username={review.rating.profile.username} />

                    <h3 className="font-bold text-base-content">{review.rating.profile.username}</h3>
                </div>

                <div className="space-y-4 text-center md:col-span-5 md:text-left">
                    <RatingProgress value={review.rating.score} />
                    <div className="text-sm">
                        <span className="font-bold">{moment(review.created_at).startOf('day').fromNow()}</span>
                    </div>
                    <article>{review.body}</article>
                </div>
            </div>
        </div>
    );
}
