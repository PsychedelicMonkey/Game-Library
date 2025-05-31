import { cn } from '@/lib/utils';
import { ComponentProps } from 'react';

function LoadingSpinner({ className, ...props }: ComponentProps<'span'>) {
    return <span className={cn('loading loading-spinner', className)} {...props}></span>;
}

function LoadingDots({ className, ...props }: ComponentProps<'span'>) {
    return <span className={cn('loading loading-dots', className)} {...props}></span>;
}

function LoadingRing({ className, ...props }: ComponentProps<'span'>) {
    return <span className={cn('loading loading-ring', className)} {...props}></span>;
}

function LoadingBall({ className, ...props }: ComponentProps<'span'>) {
    return <span className={cn('loading loading-ball', className)} {...props}></span>;
}

function LoadingBars({ className, ...props }: ComponentProps<'span'>) {
    return <span className={cn('loading loading-bars', className)} {...props}></span>;
}

export { LoadingBall, LoadingBars, LoadingDots, LoadingRing, LoadingSpinner };
