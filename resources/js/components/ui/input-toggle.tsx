import { cn } from '@/lib/utils';
import { cva, VariantProps } from 'class-variance-authority';
import React from 'react';

const toggleVariants = cva('toggle', {
    variants: {
        color: {
            primary: 'toggle-primary',
            secondary: 'toggle-secondary',
            accent: 'toggle-accent',
            neutral: 'toggle-neutral',
            success: 'toggle-success',
            warning: 'toggle-warning',
            info: 'toggle-info',
            error: 'toggle-error',
        },
        toggleSize: {
            xs: 'toggle-xs',
            sm: 'toggle-sm',
            md: 'toggle-md',
            lg: 'toggle-lg',
            xl: 'toggle-xl',
        },
    },
});

export default function Toggle({ className, color, toggleSize, ...props }: React.ComponentProps<'input'> & VariantProps<typeof toggleVariants>) {
    return <input type="checkbox" className={cn(toggleVariants({ color, toggleSize, className }))} {...props} />;
}
