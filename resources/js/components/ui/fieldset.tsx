import { cn } from '@/lib/utils';
import * as React from 'react';

function Fieldset({ children, className, ...props }: React.ComponentProps<'fieldset'>) {
    return (
        <fieldset className={cn('fieldset', className)} {...props}>
            {children}
        </fieldset>
    );
}

function FieldsetLegend({ children, className, ...props }: React.ComponentProps<'legend'>) {
    return (
        <legend className={cn('fieldset-legend', className)} {...props}>
            {children}
        </legend>
    );
}

export { Fieldset, FieldsetLegend };
