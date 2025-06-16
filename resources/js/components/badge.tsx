import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import React from 'react';

const badgeVariants = cva('badge', {
    variants: {
        color: {
            neutral: 'badge-neutral',
            primary: 'badge-primary',
            secondary: 'badge-secondary',
            accent: 'badge-accent',
            info: 'badge-info',
            success: 'badge-success',
            warning: 'badge-warning',
            error: 'badge-error',
        },
        size: {
            xs: 'badge-xs',
            sm: 'badge-sm',
            md: 'badge-md',
            lg: 'badge-lg',
            xl: 'badge-xl',
        },
        badgeStyle: {
            outline: 'badge-outline',
            dash: 'badge-dash',
            soft: 'badge-soft',
            ghost: 'badge-ghost',
        },
    },
});

function Badge({ className, color, size, badgeStyle, children, ...props }: React.ComponentProps<'span'> & VariantProps<typeof badgeVariants>) {
    return (
        <span className={cn(badgeVariants({ color, size, badgeStyle, className }))} {...props}>
            {children}
        </span>
    );
}

export { Badge, badgeVariants };
