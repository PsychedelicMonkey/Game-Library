import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import * as React from 'react';

const textareaVariant = cva('textarea', {
    variants: {
        color: {
            neutral: 'textarea-neutral',
            primary: 'textarea-primary',
            secondary: 'textarea-secondary',
            accent: 'textarea-accent',
            info: 'textarea-info',
            success: 'textarea-success',
            warning: 'textarea-warning',
            error: 'textarea-error',
        },
        textareaSize: {
            xs: 'textarea-xs',
            sm: 'textarea-sm',
            md: 'textarea-md',
            lg: 'textarea-lg',
            xl: 'textarea-xl',
        },
    },
});

export default function Textarea({
    className,
    color,
    textareaSize,
    ...props
}: React.ComponentProps<'textarea'> & VariantProps<typeof textareaVariant>) {
    return <textarea className={cn(textareaVariant, color, textareaSize, className)} {...props}></textarea>;
}
