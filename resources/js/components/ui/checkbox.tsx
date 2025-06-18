import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import * as React from 'react';

const checkboxVariants = cva('checkbox', {
    variants: {
        color: {
            primary: 'checkbox-primary',
            secondary: 'checkbox-secondary',
            accent: 'checkbox-accent',
            neutral: 'checkbox-neutral',
            success: 'checkbox-success',
            warning: 'checkbox-warning',
            info: 'checkbox-info',
            error: 'checkbox-error',
        },
        checkboxSize: {
            xs: 'checkbox-xs',
            sm: 'checkbox-sm',
            md: 'checkbox-md',
            lg: 'checkbox-lg',
            xl: 'checkbox-xl',
        },
    },
});

export default function Checkbox({
    className,
    color,
    checkboxSize,
    ...props
}: React.ComponentProps<'input'> & VariantProps<typeof checkboxVariants>) {
    return <input type="checkbox" className={cn(checkboxVariants({ className, color, checkboxSize }))} {...props} />;
}
