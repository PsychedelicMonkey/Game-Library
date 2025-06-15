import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import React from 'react';

const inputVariants = cva('input', {
    variants: {
        color: {
            neutral: 'input-neutral',
            primary: 'input-primary',
            secondary: 'input-secondary',
            accent: 'input-accent',
            info: 'input-info',
            success: 'input-success',
            warning: 'input-warning',
            error: 'input-error',
        },
        size: {
            xs: 'input-xs',
            sm: 'input-sm',
            md: 'input-md',
            lg: 'input-lg',
            xl: 'input-xl',
        },
    },
});

export default function Input({ className, color, type, ...props }: React.ComponentProps<'input'> & VariantProps<typeof inputVariants>) {
    return <input type={type} className={cn(inputVariants({ color, className }))} {...props} />;
}
