import { Navbar } from '@/components/navbar';
import { PropsWithChildren } from 'react';

export function AppLayout({ children }: PropsWithChildren) {
    return (
        <div className="min-h-screen">
            <Navbar />

            <main>{children}</main>
        </div>
    );
}
