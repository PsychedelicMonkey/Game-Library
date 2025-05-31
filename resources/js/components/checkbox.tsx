import { cn } from '@/lib/utils';
import { ComponentProps } from 'react';

export default function Checkbox({ className, ...props }: ComponentProps<'input'>) {
    return <input type="checkbox" className={cn('checkbox', className)} {...props} />;
}
