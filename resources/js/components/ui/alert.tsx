import { Icon } from '@/components/ui/icon';
import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import { CircleCheck, CircleX, Info, TriangleAlert } from 'lucide-react';
import * as React from 'react';

const alertVariant = cva('alert', {
    variants: {
        alertStyle: {
            outline: 'alert-outline',
            dash: 'alert-dash',
            soft: 'alert-soft',
        },
        color: {
            info: 'alert-info',
            success: 'alert-success',
            warning: 'alert-warning',
            error: 'alert-error',
        },
        direction: {
            horizontal: 'alert-horizontal',
            vertical: 'alert-horizontal',
        },
    },
});

function Alert({
    className,
    alertStyle,
    color,
    direction,
    icon,
    message,
    ...props
}: React.ComponentProps<'div'> & VariantProps<typeof alertVariant> & { icon?: boolean; message: string }) {
    return (
        <div role="alert" className={cn(alertVariant({ alertStyle, color, direction, className }))} {...props}>
            {icon && (
                <>
                    {color === 'info' && <Icon iconNode={Info} />}
                    {color === 'success' && <Icon iconNode={CircleCheck} />}
                    {color === 'warning' && <Icon iconNode={TriangleAlert} />}
                    {color === 'error' && <Icon iconNode={CircleX} />}
                </>
            )}
            <span>{message}</span>
        </div>
    );
}

export { Alert };
