import { cn } from '@/lib/utils';
import * as React from 'react';

function InputLabel({ className, children, ...props }: React.ComponentProps<'label'>) {
    return (
        <label className={cn('label', className)} {...props}>
            {children}
        </label>
    );
}

export { InputLabel };
