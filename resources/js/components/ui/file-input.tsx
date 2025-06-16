import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import * as React from 'react';

const fileInputVariants = cva('file-input', {
    variants: {
        color: {
            neutral: 'file-input-neutral',
            primary: 'file-input-primary',
            secondary: 'file-input-secondary',
            accent: 'file-input-accent',
            info: 'file-input-info',
            success: 'file-input-success',
            warning: 'file-input-warning',
            error: 'file-input-error',
        },
        size: {
            xs: 'file-input-xs',
            sm: 'file-input-sm',
            md: 'file-input-md',
            lg: 'file-input-lg',
            xl: 'file-input-xl',
        },
    },
});

export default function FileInput({ className, color, size, ...props }: React.ComponentProps<'input'> & VariantProps<typeof fileInputVariants>) {
    return <input type="file" className={cn(fileInputVariants({ color, size, className }))} {...props} />;
}
