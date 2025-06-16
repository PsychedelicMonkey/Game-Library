import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import React from 'react';

const loadingVariants = cva('loading', {
    variants: {
        color: {
            primary: 'text-primary',
            secondary: 'text-secondary',
            accent: 'text-accent',
            neutral: 'text-neutral',
            info: 'text-info',
            success: 'text-success',
            warning: 'text-warning',
            error: 'text-error',
        },
        type: {
            spinner: 'loading-spinner',
            dots: 'loading-dots',
            ring: 'loading-ring',
            ball: 'loading-ball',
            bars: 'loading-bars',
            infinity: 'loading-infinity',
        },
        size: {
            xs: 'loading-xs',
            sm: 'loading-sm',
            md: 'loading-md',
            lg: 'loading-lg',
            xl: 'loading-xl',
        },
    },
    defaultVariants: {
        type: 'spinner',
    },
});

function Loading({ className, color, type, size }: React.ComponentProps<'span'> & VariantProps<typeof loadingVariants>) {
    return <span className={cn(loadingVariants({ color, type, size, className }))}></span>;
}

export { Loading, loadingVariants };
