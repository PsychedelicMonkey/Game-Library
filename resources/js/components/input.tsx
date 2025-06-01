import { cn } from '@/lib/utils';
import { ComponentProps } from 'react';

function Input({ className, type, ...props }: ComponentProps<'input'>) {
    return <input type={type} data-slot="input" className={cn('input', className)} {...props} />;
}

export { Input };
