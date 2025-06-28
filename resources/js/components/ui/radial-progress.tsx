import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import * as React from 'react';

const progressVariants = cva('radial-progress', {
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
    },
});

export default function RadialProgress({
    className,
    color,
    value,
    ...props
}: React.HTMLAttributes<HTMLDivElement> & VariantProps<typeof progressVariants> & { value: number }) {
    return (
        <div
            className={cn(progressVariants({ className, color }))}
            style={{ '--value': value } as React.CSSProperties}
            aria-valuenow={value}
            role="progressbar"
            {...props}
        >
            {value}
        </div>
    );
}
