import { cn } from '@/lib/utils';
import { ComponentProps } from 'react';

export default function Button({ className, children, type, ...props }: ComponentProps<'button'>) {
    return (
        <button type={type} className={cn('btn', className)} {...props}>
            {children}
        </button>
    );
}
