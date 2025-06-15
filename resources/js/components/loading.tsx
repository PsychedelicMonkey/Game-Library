import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import React from 'react';

const loadingVariants = cva('loading', {
    variants: {
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

function Loading({ className, type, size }: React.ComponentProps<'span'> & VariantProps<typeof loadingVariants>) {
    return <span className={cn(loadingVariants({ type, size, className }))}></span>;
}

export { Loading, loadingVariants };
