import { cn } from '@/lib/utils';
import { cva, VariantProps } from 'class-variance-authority';
import React, { HTMLProps } from 'react';

const cardVariants = cva('card', {
    variants: {
        cardStyle: {
            border: 'card-border',
            dash: 'card-dash',
        },
        modifier: {
            side: 'card-side',
            full: 'image-full',
        },
        size: {
            xs: 'card-xs',
            sm: 'card-sm',
            md: 'card-md',
            lg: 'card-lg',
            xl: 'card-xl',
        },
    },
});

function Card({ className, children, cardStyle, modifier, size, ...props }: HTMLProps<HTMLDivElement> & VariantProps<typeof cardVariants>) {
    return (
        <div className={cn(cardVariants({ className, cardStyle, modifier, size }))} {...props}>
            {children}
        </div>
    );
}

function CardBody({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('card-body', className)} {...props}>
            {children}
        </div>
    );
}

function CardTitle({ className, children, ...props }: React.ComponentProps<'h2'>) {
    return (
        <h2 className={cn('card-title', className)} {...props}>
            {children}
        </h2>
    );
}

function CardActions({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('card-actions', className)} {...props}>
            {children}
        </div>
    );
}

export { Card, CardActions, CardBody, CardTitle };
