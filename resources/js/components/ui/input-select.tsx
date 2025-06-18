import { cn } from '@/lib/utils';
import { cva, VariantProps } from 'class-variance-authority';
import * as React from 'react';

const selectVariants = cva('select', {
    variants: {
        color: {
            neutral: 'select-neutral',
            primary: 'select-primary',
            secondary: 'select-secondary',
            accent: 'select-accent',
            info: 'select-info',
            success: 'select-success',
            warning: 'select-warning',
            error: 'select-error',
        },
        selectSize: {
            xs: 'select-xs',
            sm: 'select-sm',
            md: 'select-md',
            lg: 'select-lg',
            xl: 'select-xl',
        },
    },
});

function Select({ className, color, selectSize, ...props }: React.ComponentProps<'select'> & VariantProps<typeof selectVariants>) {
    return <select className={cn(selectVariants({ className, color, selectSize }))} {...props}></select>;
}

export { Select };
