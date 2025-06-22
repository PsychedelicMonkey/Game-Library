import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import { HTMLProps } from 'react';

const collapseVariants = cva('collapse', {
    variants: {
        modifier: {
            arrow: 'collapse-arrow',
            plus: 'collapse-plus',
            open: 'collapse-open',
            close: 'collapse-close',
        },
    },
});

function Collapse({ className, children, modifier, ...props }: HTMLProps<HTMLDivElement> & VariantProps<typeof collapseVariants>) {
    return (
        <div className={cn(collapseVariants({ className, modifier }))} {...props}>
            {children}
        </div>
    );
}

function CollapseTitle({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('collapse-title', className)} {...props}>
            {children}
        </div>
    );
}

function CollapseContent({ className, children, ...props }: HTMLProps<HTMLDivElement>) {
    return (
        <div className={cn('collapse-content', className)} {...props}>
            {children}
        </div>
    );
}

export { Collapse, CollapseContent, CollapseTitle };
