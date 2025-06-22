import { cn } from '@/lib/utils';
import { cva } from 'class-variance-authority';
import { HTMLProps } from 'react';

const ratingVariants = cva('rating', {
    variants: {
        modifier: {
            half: 'rating-half',
            hidden: 'rating-hidden',
        },
        size: {
            xs: 'rating-xs',
            sm: 'rating-sm',
            md: 'rating-md',
            lg: 'rating-lg',
            xl: 'rating-xl',
        },
    },
});

function RatingInput({ className, ...props }: HTMLProps<HTMLInputElement>) {
    return (
        <div className="rating">
            {[...Array(5)].map((value, index) => (
                <input key={index} type="radio" className={cn('mask mask-star', className)} aria-label={`${index + 1} star`} {...props} />
            ))}
        </div>
    );
}

function ReadOnlyRating({ className, rating, ...props }: HTMLProps<HTMLDivElement> & { rating: number }) {
    return (
        <div className={cn(ratingVariants({ className }))} {...props}>
            {[...Array(5)].map((value, index) => (
                <div key={index} className="mask mask-star" aria-label={`${index + 1} star`} aria-current={rating - 1 === index}></div>
            ))}
        </div>
    );
}

export { RatingInput, ReadOnlyRating };
