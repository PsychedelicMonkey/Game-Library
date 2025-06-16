import { cn } from '@/lib/utils';
import { cva, VariantProps } from 'class-variance-authority';
import React from 'react';

enum AlertType {
    Info,
    Success,
    Warning,
    Error,
}

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
                    {color === 'info' && AlertIcon(AlertType.Info)}
                    {color === 'success' && AlertIcon(AlertType.Success)}
                    {color === 'warning' && AlertIcon(AlertType.Warning)}
                    {color === 'error' && AlertIcon(AlertType.Error)}
                </>
            )}
            <span>{message}</span>
        </div>
    );
}

function AlertIcon(type: AlertType) {
    switch (type) {
        case AlertType.Info:
            return (
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" className="h-6 w-6 shrink-0 stroke-current">
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                </svg>
            );
        case AlertType.Success:
            return (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            );
        case AlertType.Warning:
            return (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                    />
                </svg>
            );
        case AlertType.Error:
            return (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            );
    }
}

export { Alert, AlertIcon };
