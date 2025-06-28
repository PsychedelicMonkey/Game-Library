import { Button } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import * as React from 'react';

function Modal({ className, children, id, ...props }: React.ComponentProps<'dialog'>) {
    return (
        <dialog id={id} className={cn('modal modal-bottom sm:modal-middle', className)} {...props}>
            <div className="modal-box">
                {children}

                <div className="modal-action">
                    <form method="dialog">
                        <Button>Close</Button>
                    </form>
                </div>
            </div>
        </dialog>
    );
}

export { Modal };
