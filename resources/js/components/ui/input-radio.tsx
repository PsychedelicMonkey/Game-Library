import { cn } from '@/lib/utils';
import { cva, VariantProps } from 'class-variance-authority';
import React from 'react';

const radioVariants = cva('radio', {
    variants: {
        color: {
            neutral: 'radio-neutral',
            primary: 'radio-primary',
            secondary: 'radio-secondary',
            accent: 'radio-accent',
            success: 'radio-success',
            warning: 'radio-warning',
            info: 'radio-info',
            error: 'radio-error',
        },
        radioSize: {
            xs: 'radio-xs',
            sm: 'radio-sm',
            md: 'radio-md',
            lg: 'radio-lg',
            xl: 'radio-xl',
        },
    },
});

function Radio({ className, color, radioSize, ...props }: React.ComponentProps<'input'> & VariantProps<typeof radioVariants>) {
    return <input type="radio" className={cn(radioVariants, color, radioSize, className)} {...props} />;
}

export { Radio };
