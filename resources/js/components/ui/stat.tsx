import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import { HTMLProps } from 'react';

const statsVariants = cva('stats', {
    variants: {
        direction: {
            horizontal: 'stats-horizontal',
            vertical: 'stats-vertical',
        },
    },
    defaultVariants: {
        direction: 'horizontal',
    },
});

function Stats({ className, children, direction, ...props }: HTMLProps<HTMLDivElement> & VariantProps<typeof statsVariants>) {
    return (
        <div className={cn(statsVariants({ className, direction }))} {...props}>
            {children}
        </div>
    );
}

function Stat({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('stat', className)} {...props}>
            {children}
        </div>
    );
}

function StatTitle({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('stat-title', className)} {...props}>
            {children}
        </div>
    );
}

function StatValue({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('stat-value', className)} {...props}>
            {children}
        </div>
    );
}

function StatDesc({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('stat-desc', className)} {...props}>
            {children}
        </div>
    );
}

function StatFigure({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('stat-figure', className)} {...props}>
            {children}
        </div>
    );
}

function StatActions({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('stat-actions', className)} {...props}>
            {children}
        </div>
    );
}

export { Stat, StatActions, StatDesc, StatFigure, Stats, StatTitle, StatValue };
