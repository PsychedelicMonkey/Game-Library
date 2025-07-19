import { PropsWithChildren } from 'react';

function FloatingLabel({ label, children }: PropsWithChildren & { label: string }) {
    return (
        <label htmlFor="" className="floating-label">
            <span>{label}</span>
            {children}
        </label>
    );
}

export { FloatingLabel };
