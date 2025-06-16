import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import * as React from 'react';

const progressVariants = cva('progress w-56', {
    variants: {
        color: {
            neutral: 'progress-neutral',
            primary: 'progress-primary',
            secondary: 'progress-secondary',
            accent: 'progress-accent',
            info: 'progress-info',
            success: 'progress-success',
            warning: 'progress-warning',
            danger: 'progress-danger',
        },
    },
});

export default function Progress({ className, color, ...props }: React.ComponentProps<'progress'> & VariantProps<typeof progressVariants>) {
    return <progress className={cn(progressVariants({ color, className }))} {...props}></progress>;
}
