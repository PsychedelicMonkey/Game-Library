import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import * as React from 'react';

const buttonVariants = cva('btn', {
    variants: {
        color: {
            neutral: 'btn-neutral',
            primary: 'btn-primary',
            secondary: 'btn-secondary',
            accent: 'btn-accent',
            info: 'btn-info',
            success: 'btn-success',
            warning: 'btn-warning',
            error: 'btn-error',
        },
        modifier: {
            wide: 'btn-wide',
            block: 'btn-block',
            square: 'btn-square',
            circle: 'btn-circle',
        },
        size: {
            sm: 'btn-sm',
            md: 'btn-md',
            lg: 'btn-lg',
            xl: 'btn-xl',
        },
        buttonStyle: {
            outline: 'btn-outline',
            dash: 'btn-dash',
            soft: 'btn-soft',
            ghost: 'btn-ghost',
            link: 'btn-link',
        },
    },
    defaultVariants: {
        color: 'neutral',
        size: 'md',
    },
});

function Button({
    className,
    color,
    modifier,
    size,
    buttonStyle,
    children,
    ...props
}: React.ComponentProps<'button'> & VariantProps<typeof buttonVariants>) {
    return (
        <button className={cn(buttonVariants({ color, modifier, size, buttonStyle, className }))} {...props}>
            {children}
        </button>
    );
}

export { Button };
