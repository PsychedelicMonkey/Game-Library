import { Footer } from '@/components/footer';
import { Navbar } from '@/components/navbar';
import { PropsWithChildren } from 'react';

function AppLayout({ children }: PropsWithChildren) {
    return (
        <>
            <Navbar />

            <main className="min-h-screen pt-14">{children}</main>

            <Footer />
        </>
    );
}

export { AppLayout };
