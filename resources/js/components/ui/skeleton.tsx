import { cn } from '@/lib/utils';
import { HTMLProps } from 'react';

function Skeleton({ className, ...props }: HTMLProps<HTMLDivElement>) {
    return <div className={cn('skeleton', className)} {...props}></div>;
}

export { Skeleton };
