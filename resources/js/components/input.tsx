import { cn } from '@/lib/utils';
import React from 'react';

export default function Input({ className = '', type, ...props }: React.ComponentProps<'input'>) {
    return <input type={type} className={cn('input', className)} {...props} />;
}
