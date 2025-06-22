import { cva, VariantProps } from 'class-variance-authority';
import { HTMLProps } from 'react';

const tooltipVariance = cva('tooltip', {
    variants: {
        placement: {
            top: 'tooltip-top',
            bottom: 'tooltip-bottom',
            left: 'tooltip-left',
            right: 'tooltip-right',
        },
        color: {
            neutral: 'tooltip-neutral',
            primary: 'tooltip-primary',
            secondary: 'tooltip-secondary',
            accent: 'tooltip-accent',
            info: 'tooltip-info',
            success: 'tooltip-success',
            warning: 'tooltip-warning',
            error: 'tooltip-error',
        },
        modifier: {
            open: 'tooltip-open',
        },
    },
});

function Tooltip({ children, className, placement, color, modifier, ...props }: HTMLProps<HTMLDivElement> & VariantProps<typeof tooltipVariance>) {
    return (
        <div className={tooltipVariance({ className, placement, color, modifier })} {...props}>
            {children}
        </div>
    );
}

export { Tooltip };
